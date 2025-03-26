<?php

namespace App\Http\Controllers\Manajer;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksismanajerController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        $tipeTransaksi = ['Pemasukan', 'Pengeluaran'];
        return view('manajer.transaksi.index',[
            'title' => 'transaksi',
            'transksi' => $transaksis,
            'tipeTransaksi' => $tipeTransaksi
        ]);
    }
}
