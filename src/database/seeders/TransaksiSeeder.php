<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaksi::create([
            'kode_transaksi' => 'TRX001',
            'user_id' => 1,
            'tipe_transaksi' => 'penjualan',
            'total_harga' => 8000000,
            'tanggal_transaksi' => now(),
            'keterangan' => 'Penjualan laptop',
            'status_pembayaran' => 'lunas',
        ]);
    }
}