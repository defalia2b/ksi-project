<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenyesuaianStok;

class PenyesuaianStokSeeder extends Seeder
{
    public function run(): void
    {
        PenyesuaianStok::create([
            'barang_id' => 1,
            'user_id' => 1,
            'tipe_penyesuaian' => 'penambahan',
            'jumlah_perubahan' => 5,
            'keterangan' => 'Restock awal',
            'tanggal_penyesuaian' => now(),
        ]);
    }
}