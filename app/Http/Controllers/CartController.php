<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class CartController extends Controller
{
    //index
    public function index()
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek jika ada cart sesuai dengan customer yang login
        $customer = Auth::guard('customer')->user()->id;
        $cart = Order::getCustomerCart($customer);

        $cart = Order::with(['orderItems' => function ($query) {
            $query->orderBy('id', 'asc'); // Order orderItems by id in ascending order
        }])->find($cart->id);

        return view('cart.index', compact('cart'));
    }

    public function tambah_item($id)
    {

        $this->update_item($id, 1);
        return redirect()->route('cart');
    }

    public function kurang_item($id)
    {
        $this->update_item($id, -1);
        return redirect()->route('cart');
    }

    public function hapus_item($id)
    {
        $this->update_item($id, 0);
        return redirect()->route('cart');
    }


    private function update_item($id, $jumlah)
    {
        // Ensure the user is authenticated
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;

        $orderItem = OrderItem::where('id', $id)
            ->whereHas('order', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->first();

        if (!$orderItem) {
            return redirect()->back()->with('error', 'Order item tidak ditemukan');
        }

        $delete = false;

        if ($jumlah == 0) {
            $orderItem->delete();
            $delete = true;
        } else {
            $new_jumlah = $orderItem->jumlah + $jumlah;

            if ($new_jumlah > 0) {
                $orderItem->jumlah = $new_jumlah;
                $orderItem->save();
            } else {
                $orderItem->delete();
                $delete = true;
            }
        }

        if ($delete) {
            return redirect()->route('admin.meja')->with('success', 'Makanan dihapus dari keranjang.');
        }
        return redirect()->route('admin.meja')->with('success', 'Jumlah keranjang berhasi diubah.');
    }

    public function pesan(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;
        // Get the current user's cart (order with status 0)
        $cart = Order::where('customer_id', $customerId)
            ->where('status', 0)
            ->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Tidak ada keranjang aktif untuk pengguna saat ini.');
        }

        $kodeMeja = $request->input('kode');

        // Check if Meja with $kodeMeja exists
        $meja = Meja::where('kode', $kodeMeja)->first();

        if (!$meja) {
            return redirect()
                ->back()
                ->withErrors('Meja dengan kode tersebut tidak ditemukan.')
                ->withInput();
        }

        // Step 2: Check if Meja is not related to any orders
        $existingOrder = Order::where('meja_id', $meja->id)
            ->where('status', 1)
            ->first();

        if ($existingOrder) {
            return redirect()
                ->back()
                ->withErrors('Meja dengan kode tersebut sudah digunakan untuk pemesanan yang sedang aktif.')
                ->withInput();
        }


        // Update the cart to associate with the Meja and update status
        $cart->meja_id = $meja->id;
        $cart->status = 1; 
        $cart->tgl_pemesanan = new DateTime();
     

        $total = 0;
        foreach ($cart->orderItems as $orderItem) {
            $total += $orderItem->jumlah * $orderItem->harga;
        }

        $cart->total = $total;
        $cart->save();

        

        return redirect()->route('cart.konfirmasi')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    public function konfirmasi(){
         // Ensure the user is authenticated
         if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;
        $order = Order::where('customer_id', $customerId)
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        if($order){
            return view('cart.konfirmasi', compact('order'));
        }else{
            return redirect()->route('beranda');
        }
        
    }
}
