<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //login
    public function login()
    {
        return view('customer.login');
    }

    //login
    public function registrasi()
    {
        return view('customer.registrasi');
    }

    //check login
    public function cek_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('beranda')->with('success', 'Login berhasil');;
        } else {
            return redirect()
                ->back()
                ->withErrors('Username atau password salah.')
                ->withInput();
        }
    }

    public function buat_akun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:8',
            'no_hp' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('customer.login')->with('success', 'Registrasi akun berhasil.');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
