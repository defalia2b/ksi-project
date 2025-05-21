<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama' => 'Laptop Asus',
            'sku' => 'ASUS123',
            'kategori_id' => 1,
            'supplier_id' => 1,
            'deskripsi' => 'Laptop Asus Core i5',
            'harga_beli' => 7000000,
            'harga_jual' => 8000000,
            'stok' => 10,
            'berat' => 2,
            'satuan' => 'unit',
            'gambar' => null,
            'status' => 'aktif',
        ]);
        Produk::create([
            'nama' => 'Kaos Polos',
            'sku' => 'KAOS001',
            'kategori_id' => 2,
            'supplier_id' => 2,
            'deskripsi' => 'Kaos polos warna putih',
            'harga_beli' => 30000,
            'harga_jual' => 50000,
            'stok' => 50,
            'berat' => 0.2,
            'satuan' => 'pcs',
            'gambar' => null,
            'status' => 'aktif',
        ]);
    }
}