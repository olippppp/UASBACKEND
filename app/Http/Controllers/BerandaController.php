<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //index
    public function index()
    {
        $menu = Menu::orderBy('menu.id', 'desc')->join('kategori', 'kategori.id', "=", "menu.kategori")
            ->select('menu.*', 'kategori.nama as kategori_nama')
            ->limit(8)
            ->get();

        return view('beranda', compact('menu'));
    }
}
