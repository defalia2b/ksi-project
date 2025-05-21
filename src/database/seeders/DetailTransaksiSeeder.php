<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DetailTransaksi::create([
            'transaksi_id' => 1,
            'barang_id' => 1,
            'jumlah' => 1,
            'harga_satuan' => 8000000,
            'subtotal' => 8000000,
            'keterangan' => 'Laptop Asus',
        ]);
    }
}