<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\bukuBesar;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request)
    {
        $semuaAkun = Akun::all();
        $query = bukuBesar::with('akun');

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }
        if ($request->akun_id) {
            $query->where('akun_id', $request->akun_id);
        }

        $buku = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.bukuBesar.index', compact('buku', 'semuaAkun'));
    }
}
