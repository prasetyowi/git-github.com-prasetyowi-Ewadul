<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (Session::get('login') == TRUE) {
            return view('dashboard/index');
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
