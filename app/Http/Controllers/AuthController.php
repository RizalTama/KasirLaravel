<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect ke halaman kasir
        if (session('id_user')) {
            return redirect()->route('kasir.index');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Cek apakah role adalah kasir
            if ($user->role === 'kasir') {
                session(['id_user' => $user->id]);
                session(['username' => $user->username]);
                session(['role' => $user->role]);
                
                return redirect()->route('kasir.index')->with('success', 'Login berhasil!');

            } else if ($user->role === 'admin') {
                session(['id_user' => $user->id]);
                session(['username' => $user->username]);
                session(['role' => $user->role]);
                
                return redirect()->route('admin.index')->with('success', 'Login berhasil!');
            } else {
                // Jika role bukan kasir dan admin')
                return back()->with('error', 'Akses ditolak. Hanya karyawan dan admin yang dapat mengakses sistem ini.');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}