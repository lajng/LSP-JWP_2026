<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    protected $table = 'persediaans';

    protected $fillable = [
        'barang_id',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
