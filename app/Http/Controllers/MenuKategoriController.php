<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class MenuKategoriController extends Controller
{
    //index
    public function index()
    {
        $menu = Menu::orderBy('menu.nama', 'asc')->join('kategori', 'kategori.id', "=", "menu.kategori")
            ->select('menu.*', 'kategori.nama as kategori_nama')
            ->get();

        $kategori = Menu::join('kategori', 'kategori.id', "=", "menu.kategori")
            ->select('kategori.id as kategori_id', 'kategori.nama as kategori_nama', DB::raw('COUNT(*) as count'))
            ->groupBy('kategori.id')
            ->get();

        $total_menu = Menu::count();

        return view('menu_kategori.index', compact('menu', 'kategori', 'total_menu'));
    }
}
