<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Exception;

class MenuController extends Controller
{
     //index
     public function index()
     {
         $menu = Menu::orderBy('menu.nama', 'asc')
             ->get();
 
         return view('admin.menu.index', compact('menu'));
     }
 
     //create
     public function create()
     {
         $kategori = Kategori::orderBy('nama', 'asc')->get();
         return view('admin.menu.create', compact('kategori'));
     }
 
     //store
     public function store(Request $request)
     {
         $request->validate([
             'nama' => 'required',
             'kategori' => 'required',
             'deskripsi' => 'required',
             'harga' => 'required',
             'file' => 'required|file',
         ]);
 
         $dataFoto = base64_encode(file_get_contents($request->file('file')->getRealPath()));
 
 
         try {
             DB::table('menu')->insert([
                 'nama' => $request->nama,
                 'kategori_id' => $request->kategori,
                 'deskripsi' => $request->deskripsi,
                 'harga' => $request->harga,
                 'foto' => $dataFoto
             ]);
         } catch (Exception $e) {
             return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
         }
 
         return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambah');
     }
 
     //edit
     public function edit($id)
     {
         $menu = Menu::find($id);
         $kategori = Kategori::orderBy('nama', 'asc')->get();
         return view('admin.menu.edit', compact('menu', 'kategori'));
     }
 
     //update
     public function update(Request $request, $id)
     {
         $request->validate([
             'nama' => 'required',
             'kategori' => 'required',
             'deskripsi' => 'required',
             'harga' => 'required'
         ]);
 
 
         try {
             $update = [
                 'nama' => $request->nama,
                 'kategori_id' => $request->kategori,
                 'deskripsi' => $request->deskripsi,
                 'harga' => $request->harga
             ];
 
             if ($request->hasFile('file')) {
                 $dataFoto = base64_encode(file_get_contents($request->file('file')->getRealPath()));
                 $update["foto"] = $dataFoto;
             }
 
             Menu::whereId($id)->update($update);
         } catch (Exception $e) {
             return redirect()->back()->with('error', 'Gagal mengubah data: ' . $e->getMessage());
         }
 
 
         return redirect()->route('admin.menu')->with('success', 'Menu berhasil diubah.');
     }
 
     //destroy
     public function destroy($id)
     {
         $menu = Menu::find($id);
         $menu->delete();
 
         return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus.');
     }

     
}


