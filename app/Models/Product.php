<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga_produk',
        'stok',
    ];

    // hash many
    public function DetailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
