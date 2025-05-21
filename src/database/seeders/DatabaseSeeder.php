<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        // $user->assignRole('super_admin');
        $this->call([
            // BarangSeeder::class,
            KategoriSeeder::class,
            SupplierSeeder::class,
            ProdukSeeder::class,
            TransaksiSeeder::class,
            DetailTransaksiSeeder::class,
            PenyesuaianStokSeeder::class,
            // Add other seeders here
        ]);
    }
}
