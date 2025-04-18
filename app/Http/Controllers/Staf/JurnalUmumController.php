<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    public function index() {
        $jurnalUmum = Transaksi::all();
        return view('staf.jurnalUmum.index', [
            'jurnalUmum' => $jurnalUmum,
            'title' => 'Jurnal Umum',
        ]);
    }
}
