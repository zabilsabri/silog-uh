<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            if(Auth::user()->role === 'admin') {
                return redirect()->route('home-admin')->with('success', 'Login Berhasil!');
            }
            return redirect()->route('profile')->with('success', 'Login Berhasil!');
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
