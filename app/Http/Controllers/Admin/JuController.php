<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\jurnalUmum;
use Illuminate\Http\Request;

class JuController extends Controller
{
    public function index(Request $request)
    {
        $query = JurnalUmum::with('akun');

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $jurnal = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.jurnalUmum.index', compact('jurnal'));
    }
}
