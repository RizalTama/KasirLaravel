<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $user = User::where('role', 'kasir')->first(); // Mengambil user kasir pertama
        $produk = Produk::first(); // Mengambil produk pertama

        Transaksi::create([
            'user_id' => $user->id,
            'produk_id' => $produk->id,
            'jumlah' => 3,
            'total_harga' => 3 * $produk->harga,
            'bayar' => 300000,
            'kembalian' => 100000,
        ]);
    }
}
