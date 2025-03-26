<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $akuns = Akun::all();
        return view('staf.akun.index', [
            'title' => 'Kode Akun',
            'user' => $user,
            'akuns' => $akuns
        ]);
    }

    public function create()
    {
        return view('staf.akun.create', [ 
            'title' => 'Tambah Kode Akun'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kode' => 'required|unique:akuns,kode',
                'nama_akun' => 'required'
            ]);

            Akun::create([
                'kode' => $request->kode,
                'nama_akun' => $request->nama_akun
            ]);

            return redirect()->route('index.kodeAkun')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $e) {  
            return redirect()->route('index.kodeAkun')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } 
    }
}
