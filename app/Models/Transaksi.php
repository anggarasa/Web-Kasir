<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'uang_diberikan',
        'total_harga',
        'kembalian',
        'tgl_transaksi',
    ];

    // belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // hash many
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
