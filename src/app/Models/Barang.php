<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'kategori',
        'keterangan',
    ];

        // Example relationship (if Barang belongs to another model, e.g., Category)
        public function category()
        {
            return $this->belongsTo(Category::class, 'kategori', 'id');
        }
}
