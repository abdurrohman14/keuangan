<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;

class kodeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $akuns = Akun::all();
        return view('manajer.kode.index', [
            'title' => 'Kode Akun',
            'user' => $user,
            'akuns' => $akuns
        ]);
    }
}
