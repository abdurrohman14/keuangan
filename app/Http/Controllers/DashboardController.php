<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin() {
        return view('partials.adminDashboard');
    }

    public function staf() {
        return view('partials.stafDashboard');
    }

    public function manajer() {
        return view('partials.manajerDashboard');
    }
}

