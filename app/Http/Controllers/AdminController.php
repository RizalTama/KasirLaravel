<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $totalPRoduk = Produk::count();
        $totalTransaksi = Transaksi::count();
        $totalUser = User::count();

        // Menghitung total pendapatan bulan ini dari kolom 'bayar'
        $totalPendapatanBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('bayar');

        return view('admin.dashboard.index', compact(
            'totalPRoduk',
            'totalTransaksi',
            'totalUser',
            'totalPendapatanBulanIni'
        ));
    }

    public function produk_index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }



    public function produkcreate()
    {
        return response()->json(['success' => true]);
    }

    public function produkstore(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $gambar = $file->storeAs('produk', $filename, 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function produkshow($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

    public function produkedit($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

    public function produkupdate(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $gambar = $produk->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($gambar && Storage::disk('public')->exists($gambar)) {
                Storage::disk('public')->delete($gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $gambar = $file->storeAs('produk', $filename, 'public');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function produkdelete($id)
{
    $produk = Produk::findOrFail($id);
    
    // Cek apakah produk masih digunakan dalam transaksi
    $transaksiCount = Transaksi::where('produk_id', $id)->count();
    
    if ($transaksiCount > 0) {
        return redirect()->route('admin.produk.index')
                        ->with('error', 'Produk tidak dapat dihapus! Produk ini masih digunakan dalam ' . $transaksiCount . ' transaksi.');
    }
    
    // Hapus gambar jika ada
    if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
        Storage::disk('public')->delete($produk->gambar);
    }
    
    $produk->delete();
    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
}

    public function kasir_index()
    {
        return view('admin.kasir.index');
    }
}
