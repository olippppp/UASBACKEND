<?php

use App\Http\Controllers\AdminAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminMejaController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuKategoriController;
use App\Http\Controllers\OrderController;

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

Route::middleware(['auth'])->group(function () {
  Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

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

  //meja
  Route::get('/admin/meja', [AdminMejaController::class, 'index'])->name('admin.meja');
  Route::get('/admin/meja/create', [AdminMejaController::class, 'create'])->name('admin.meja.create');
  Route::get('/admin/meja/edit/{id}', [AdminMejaController::class, 'edit'])->name('admin.meja.edit');
  Route::post('/admin/meja/store', [AdminMejaController::class, 'store'])->name('admin.meja.store');
  Route::put('/admin/meja/update/{id}', [AdminMejaController::class, 'update'])->name('admin.meja.update');
  Route::delete('/admin/meja/destroy/{id}', [AdminMejaController::class, 'destroy'])->name('admin.meja.destroy');
  Route::get('/admin/meja/{id}/qrcode', [AdminMejaController::class, 'generateQrCode'])->name('meja.qrcode');

  //admin
  Route::get('/admin/admin', [AdminAdminController::class, 'index'])->name('admin.admin');
  Route::get('/admin/admin/create', [AdminAdminController::class, 'create'])->name('admin.admin.create');
  Route::get('/admin/admin/edit/{id}', [AdminAdminController::class, 'edit'])->name('admin.admin.edit');
  Route::post('/admin/admin/store', [AdminAdminController::class, 'store'])->name('admin.admin.store');
  Route::put('/admin/admin/update/{id}', [AdminAdminController::class, 'update'])->name('admin.admin.update');
  Route::delete('/admin/admin/destroy/{id}', [AdminAdminController::class, 'destroy'])->name('admin.admin.destroy');

  //customer
  Route::get('/admin/customer', [AdminCustomerController::class, 'index'])->name('admin.customer');
  Route::get('/admin/customer/create', [AdminCustomerController::class, 'create'])->name('admin.customer.create');
  Route::get('/admin/customer/edit/{id}', [AdminCustomerController::class, 'edit'])->name('admin.customer.edit');
  Route::post('/admin/customer/store', [AdminCustomerController::class, 'store'])->name('admin.customer.store');
  Route::put('/admin/customer/update/{id}', [AdminCustomerController::class, 'update'])->name('admin.customer.update');
  Route::delete('/admin/customer/destroy/{id}', [AdminCustomerController::class, 'destroy'])->name('admin.customer.destroy');

  Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
  Route::get('/admin/orders/detail/{id}', [AdminOrderController::class, 'detail'])->name('admin.orders.detail');
  Route::get('/admin/orders/ubah_status/{id}', [AdminOrderController::class, 'ubah_status'])->name('admin.orders.ubah_status');
  Route::put('/admin/orders/ubah_status/{id}', [AdminOrderController::class, 'ubah_status_process'])->name('admin.orders.ubah_status_process');
});


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware(['cart.item.count'])->group(function () {
  Route::get('/', [BerandaController::class, 'index'])->name('beranda');
  Route::get('/kontak', [BerandaController::class, 'kontak'])->name('kontak');

  Route::get('/menu', [MenuKategoriController::class, 'index'])->name('menu_kategori');
  Route::get('/menu/add_to_cart/{id}', [MenuKategoriController::class, 'add_to_cart'])->name('menu_kategori.add_to_cart');

  Route::get('/login', [CustomerController::class, 'login'])->name('customer.login');
  Route::post('/cek_login', [CustomerController::class, 'cek_login'])->name('customer.cek_login');
  Route::get('/registrasi', [CustomerController::class, 'registrasi'])->name('customer.registrasi');
  Route::post('/buat_akun', [CustomerController::class, 'buat_akun'])->name('customer.buat_akun');
  Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');


  //cart
  Route::get('/cart', [CartController::class, 'index'])->name('cart');
  Route::get('/cart/order_item/{id}/kurang', [CartController::class, 'kurang_item'])->name('cart.order_item.kurang');
  Route::get('/cart/order_item/{id}/tambah', [CartController::class, 'tambah_item'])->name('cart.order_item.tambah');
  Route::get('/cart/order_item/{id}/hapus', [CartController::class, 'hapus_item'])->name('cart.order_item.hapus');
  Route::post('/cart/pesan', [CartController::class, 'pesan'])->name('cart.pesan');
  Route::get('/cart/konfirmasi', [CartController::class, 'konfirmasi'])->name('cart.konfirmasi');

  Route::get('/orders', [OrderController::class, 'index'])->name('orders');
  Route::get('/orders/detail/{id}', [OrderController::class, 'detail'])->name('orders.detail');
});
