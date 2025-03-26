<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'akun_id',
        'tanggal_transaksi', 
        'tipe_transaksi',
        'rekening',
        'keterangan',
        'jumlah'
    ];

    public function akun(){
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
