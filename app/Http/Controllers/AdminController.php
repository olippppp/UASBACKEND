<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //index
    public function index()
    {
        return view('admin.index');
    }

    //admin login
    public function login()
    {
        return view('admin.login');
    }

    //cek login
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin')->with('success', 'Login berhasil');;
        } else {
            return redirect()
                ->back()
                ->withErrors('Username atau password salah.')
                ->withInput();
        }
    }

     //logout
     public function logout()
     {
         Auth::logout();
         return redirect()->route('admin.login');
     }
}
