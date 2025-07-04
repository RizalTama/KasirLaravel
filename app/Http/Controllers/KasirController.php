<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $produk = Produk::where('nama_produk', 'LIKE', '%' . $search . '%')
                           ->orWhere('deskripsi', 'LIKE', '%' . $search . '%')
                           ->where('stok', '>', 0)
                           ->get();
        } else {
            $produk = Produk::where('stok', '>', 0)->get();
        }

        return view('kasir.index', compact('produk', 'search'));
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        
        $produk = Produk::where('nama_produk', 'LIKE', '%' . $search . '%')
                       ->orWhere('deskripsi', 'LIKE', '%' . $search . '%')
                       ->where('stok', '>', 0)
                       ->get();

        return response()->json($produk);
    }

 public function proses_transaksi(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            $total_harga = 0;
            $items = $request->items;
            $transaksi_ids = [];

            // Hitung total harga dan validasi stok
            foreach ($items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                if ($produk->stok < $item['jumlah']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok {$produk->nama_produk} tidak mencukupi. Stok tersedia: {$produk->stok}"
                    ]);
                }

                $total_harga += $produk->harga * $item['jumlah'];
            }

            $bayar = $request->bayar;
            $kembalian = $bayar - $total_harga;

            if ($kembalian < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Uang yang dibayarkan kurang dari total harga.'
                ]);
            }

            // Generate nomor invoice
            $invoice_number = 'INV-' . date('YmdHis') . '-' . rand(1000, 9999);

            // Simpan transaksi dan kurangi stok
            foreach ($items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                // Simpan transaksi
                $transaksi = Transaksi::create([
                    'user_id' => session('id_user'),
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'total_harga' => $produk->harga * $item['jumlah'],
                    'bayar' => $bayar,
                    'kembalian' => $item === end($items) ? $kembalian : 0,
                    'invoice_number' => $invoice_number,
                    'tanggal' => now()
                ]);

                $transaksi_ids[] = $transaksi->id;

                // Kurangi stok
                $produk->decrement('stok', $item['jumlah']);
            }

            DB::commit();

            // Generate PDF
            $pdf_url = $this->generateInvoicePDF($transaksi_ids, $invoice_number);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil!',
                'data' => [
                    'total_harga' => $total_harga,
                    'bayar' => $bayar,
                    'kembalian' => $kembalian,
                    'invoice_number' => $invoice_number,
                    'pdf_url' => $pdf_url
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    private function generateInvoicePDF($transaksi_ids, $invoice_number)
    {
        // Ambil data transaksi dengan relasi
        $transaksis = Transaksi::with(['produk', 'user'])
            ->whereIn('id', $transaksi_ids)
            ->get();

        $data = [
            'invoice_number' => $invoice_number,
            'transaksis' => $transaksis,
            'total_harga' => $transaksis->sum('total_harga'),
            'bayar' => $transaksis->first()->bayar,
            'kembalian' => $transaksis->where('kembalian', '>', 0)->sum('kembalian'),
            'tanggal' => $transaksis->first()->created_at,
            'kasir' => $transaksis->first()->user->name ?? 'Admin'
        ];

        $pdf = Pdf::loadView('invoice.nota', $data);
        
        // Simpan PDF ke storage
        $filename = 'invoice_' . $invoice_number . '.pdf';
        $pdf->save(storage_path('app/public/invoices/' . $filename));

        return asset('storage/invoices/' . $filename);
    }

    public function download_invoice($invoice_number)
    {
        $filename = 'invoice_' . $invoice_number . '.pdf';
        $path = storage_path('app/public/invoices/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        }

        return abort(404);
    }
}