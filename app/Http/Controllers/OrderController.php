<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     //index
     public function index(Request $request)
     {
         if (!Auth::guard("customer")->check()) {
             return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
         }
 
         $customer = Auth::guard('customer')->user()->id;
 
         $query = Order::query();
 
         $query->where('orders.status', '!=', 0);
         $query->where('customer_id', $customer);
 
         if ($request->has('status')) {
             $query->where('orders.status', $request->status);
         }
 
         if ($request->has('cari')) {
             $keyword = $request->cari;
             $query->where(function ($query) use ($keyword) {
                 $query->where('no_order', 'ilike', '%' . $keyword . '%');
             });
         }
 
         // Sorting
         $validSortColumns = ['tanggal_terakhir', 'tanggal_terawal', 'price_asc', 'price_desc'];
         $sort_by = $request->input('sort_by', 'tanggal_terakhir'); // Default sort by name_asc
         if (!in_array($sort_by, $validSortColumns)) {
             $sort_by = 'tanggal_terakhir'; // Default to name_asc if invalid value
         }
 
         switch ($sort_by) {
             case 'tanggal_terakhir':
                 $query->orderBy('orders.tgl_pemesanan', 'desc');
                 break;
             case 'tanggal_terawal':
                 $query->orderBy('orders.tgl_pemesanan', 'asc');
                 break;
             case 'price_asc':
                 $query->orderBy('orders.total', 'asc');
                 break;
             case 'price_desc':
                 $query->orderBy('orders.total', 'desc');
                 break;
             default:
                 $query->orderBy('orders.tgl_pemesanan', 'desc');
                 break;
         }
 
         // Pagination with items per page
         $items_per_page = $request->input('items_per_page', 10); // Default items per page
 
         $orders = $query->paginate($items_per_page);
 
         $query = Order::query();
 
         if ($request->has('cari')) {
             $keyword = $request->cari;
             $query->where(function ($query) use ($keyword) {
                 $query->where('no_order', 'ilike', '%' . $keyword . '%');;
             });
         }
 
         $orders_total = $query->count();
 
         $status_pemesanan = [
             1 => 'Sedang diproses',
             2 => 'Selesai'
         ];
 
         return view('order.index', compact('orders', 'orders_total', 'status_pemesanan'));
     }

     public function detail($id)
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek jika ada order customer dengan status = 0 (cart)
        $customer = Auth::guard('customer')->user()->id;

        $order = Order::orderBy('id', 'desc')->where('customer_id', $customer)->where('status', '!=', 0)->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.menu')->find($order->id);


        $status_pemesanan = [
            1 => 'Sedang diproses',
            2 => 'Selesai'
        ];

        return view('order.detail', compact('order', 'status_pemesanan'));
    }
}
