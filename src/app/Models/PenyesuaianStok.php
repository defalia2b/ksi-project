<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyesuaianStok extends Model
{
    protected $table = 'penyesuaian_stoks';

    protected $fillable = [
        'barang_id',
        'user_id',
        'tipe_penyesuaian',
        'jumlah_perubahan',
        'keterangan',
        'tanggal_penyesuaian',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
