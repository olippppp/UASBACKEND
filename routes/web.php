<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuKategoriController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

//kategori
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
Route::post('/admin/kategori/store', [KategoriController::class, 'store'])->name('admin.kategori.store');
Route::put('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
Route::delete('/admin/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

//menu
Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu');
Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
Route::get('/admin/menu/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
Route::post('/admin/menu/store', [MenuController::class, 'store'])->name('admin.menu.store');
Route::put('/admin/menu/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
Route::delete('/admin/menu/destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');

Route::get('/menu', [MenuKategoriController::class, 'index'])->name('menu_kategori');