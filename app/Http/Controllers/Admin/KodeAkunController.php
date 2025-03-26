<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Auth;
use Illuminate\Http\Request;


class KodeAkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $akuns = Akun::all();
        return view('admin.kodeAkun.index', [
            'title' => 'Kode Akun',
            'user' => $user,
            'akuns' => $akuns
        ]);
    }
}