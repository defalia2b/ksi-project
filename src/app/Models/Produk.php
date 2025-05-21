<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama',
        'sku',
        'kategori_id',
        'supplier_id',
        'deskripsi',
        'harga_beli',
        'harga_jual',
        'stok',
        'berat',
        'satuan',
        'gambar',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_id');
    }

    public function penyesuaianStok()
    {
        return $this->hasMany(PenyesuaianStok::class, 'barang_id');
    }
}
