<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //index
    public function index()
    {
        $menu = Menu::orderBy('menu.id', 'desc')
            ->limit(8)
            ->get();

        return view('beranda', compact('menu'));
    }

    //index
    public function kontak()
    {
        return view('kontak');
    }
}
