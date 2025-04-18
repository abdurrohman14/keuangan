<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurnalUmum extends Model
{
    protected $fillable = [
        'tanggal', 'akun_id', 'transaksi_id', 'debit', 'kredit', 'keterangan'
    ];

    public function akun() {
        return $this->belongsTo(Akun::class);
    }

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
}
