<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create([
            'nama' => 'Elektronik',
            'slug' => 'elektronik',
            'deskripsi' => 'Kategori barang elektronik',
        ]);
        Kategori::create([
            'nama' => 'Pakaian',
            'slug' => 'pakaian',
            'deskripsi' => 'Kategori pakaian',
        ]);
    }
}