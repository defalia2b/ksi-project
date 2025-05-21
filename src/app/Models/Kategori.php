<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}