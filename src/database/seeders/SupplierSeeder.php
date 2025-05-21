<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'nama' => 'PT Sumber Makmur',
            'kontak_person' => 'Budi',
            'email' => 'budi@sumbermakmur.com',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Mawar No. 1, Jakarta',
        ]);
        Supplier::create([
            'nama' => 'CV Jaya Abadi',
            'kontak_person' => 'Siti',
            'email' => 'siti@jayaabadi.com',
            'telepon' => '08234567890',
            'alamat' => 'Jl. Melati No. 2, Bandung',
        ]);
    }
}