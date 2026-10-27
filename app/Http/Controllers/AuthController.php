<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:pelanggans,email'],
            'no_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make($data['password']),
        ]);

        $request->session()->regenerate();
        $request->session()->put('pelanggan_id', $pelanggan->id);

        return redirect()
            ->route('booking.index')
            ->with('success', 'Akun berhasil dibuat. Selamat datang di CUTIFY!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $pelanggan = Pelanggan::where('email', $data['email'])->first();

        if (!$pelanggan || !Hash::check($data['password'], $pelanggan->password)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('pelanggan_id', $pelanggan->id);

        return redirect()->intended(route('booking.index'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('pelanggan_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Lu berhasil logout.');
    }
}
