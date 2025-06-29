<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
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

            // Simpan transaksi dan kurangi stok
            foreach ($items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                // Simpan transaksi
                Transaksi::create([
                    'user_id' => session('id_user'),
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'total_harga' => $produk->harga * $item['jumlah'],
                    'bayar' => $bayar, // Total bayar untuk semua item
                    'kembalian' => $item === end($items) ? $kembalian : 0 // Kembalian hanya di item terakhir
                ]);

                // Kurangi stok
                $produk->decrement('stok', $item['jumlah']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil!',
                'data' => [
                    'total_harga' => $total_harga,
                    'bayar' => $bayar,
                    'kembalian' => $kembalian
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
}