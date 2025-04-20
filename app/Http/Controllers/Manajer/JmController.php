<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jurnalUmum;

class JmController extends Controller
{
    public function index(Request $request)
    {
        $query = JurnalUmum::with('akun');

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $jurnal = $query->orderBy('tanggal', 'desc')->get();

        return view('staf.jurnalUmum.index', compact('jurnal'));
    }
}
