<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'nama',
        'kontak_person',
        'email',
        'telepon',
        'alamat',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'supplier_id');
    }
}