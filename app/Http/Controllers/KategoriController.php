<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    //index
    public function index()
    {
        $kategori = Kategori::orderBy('nama', 'asc')->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    //create
    public function create()
    {
        return view('admin.kategori.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        DB::table('kategori')->insert([
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambah.');
    }

    //edit
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $update = [
            'nama' => $request->nama
        ];
        
        Kategori::whereId($id)->update($update);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diubah.');
    }

    //destroy
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
