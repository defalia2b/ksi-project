<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Barang A',
            'satuan' => 'pcs',
            'kategori' => 'Kategori 1',
            'keterangan' => 'Keterangan Barang A',
        ]);
    }
}
