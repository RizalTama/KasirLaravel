<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        Produk::create([
            'nama_produk' => 'Produk A',
            'deskripsi' => 'Deskripsi Produk A',
            'gambar' => 'produk_a.jpg',
            'stok' => 100,
            'harga' => 50000,
        ]);

        Produk::create([
            'nama_produk' => 'Produk B',
            'deskripsi' => 'Deskripsi Produk B',
            'gambar' => 'produk_b.jpg',
            'stok' => 200,
            'harga' => 70000,
        ]);

        Produk::create([
            'nama_produk' => 'Produk C',
            'deskripsi' => 'Deskripsi Produk C',
            'gambar' => 'produk_c.jpg',
            'stok' => 150,
            'harga' => 80000,
        ]);
    }
}
