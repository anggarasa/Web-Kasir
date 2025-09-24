<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama',
        'username',
        'tgl_lahir',
        'no_hp',
        'alamat',
    ];

    // hash many
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
