<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'Admin') {
                return redirect('/admin/dashboard');
            } else if (Auth::user()->role == 'Guru') {
                return redirect('/guru/dashboard');
            } else if (Auth::user()->role == 'Siswa') {
                return redirect('siswa/dashboard');
            } else {
                return redirect()->back()->with('error', 'Username atau Password Salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
