<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminKasirController extends Controller
{
    /**
     * Display a listing of kasir.
     */
    public function index()
    {
        // Ambil semua kasir dengan role 'kasir' 
        $kasirs = User::where('role', 'kasir')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('admin.kasir.index', compact('kasirs'));
    }

    /**
     * Show the form for creating a new kasir.
     */
    public function create()
    {
        return view('admin.kasir.create');
    }

    /**
     * Store a newly created kasir in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user,username',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir',
        ]);

        return redirect()->route('admin.kasir.index')
                        ->with('success', 'Kasir berhasil ditambahkan!');
    }

    /**
     * Display the specified kasir.
     */
    public function show($id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        return view('admin.kasir.show', compact('kasir'));
    }

    /**
     * Show the form for editing the specified kasir.
     */
    public function edit($id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);
        
        return view('admin.kasir.edit', compact('kasir'));
    }

    /**
     * Update the specified kasir in storage.
     */
    public function update(Request $request, $id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('user', 'username')->ignore($kasir->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user', 'email')->ignore($kasir->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $updateData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $kasir->update($updateData);

        return redirect()->route('admin.kasir.index')
                        ->with('success', 'Data kasir berhasil diperbarui!');
    }

    /**
     * Remove the specified kasir from storage.
     */
    public function destroy($id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        // Cek apakah kasir masih memiliki transaksi (jika relasi transaksi sudah tersedia)
        // Uncomment baris ini jika model Transaksi sudah ada
        // if ($kasir->transaksi()->count() > 0) {
        //     return redirect()->route('admin.kasir.index')
        //                    ->with('error', 'Tidak dapat menghapus kasir yang masih memiliki transaksi!');
        // }

        $kasir->delete();

        return redirect()->route('admin.kasir.index')
                        ->with('success', 'Kasir berhasil dihapus!');
    }
}