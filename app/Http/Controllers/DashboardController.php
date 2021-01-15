<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // check if signed up
        // dd(auth()->user());
        return view('dashboard');
    }
}
