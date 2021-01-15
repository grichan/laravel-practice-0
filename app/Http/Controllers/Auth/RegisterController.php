<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
    // dd();

        return view('auth.register');
    }

    public function store(Request $request)
    {
        // die dump kills page outputs input
        // dd('abc');
        // dd($request->only('email', 'password'));

        // validation

        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        // store user

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'username' => $request->username,
            // Hash is a facade for underlying functionality
            'password' => Hash::make($request->password),
        ]);

        // sign user in

        Auth::attempt($request->only('email', 'password'));

        // redirect

        return redirect()->route('dashboard');

    }
}
