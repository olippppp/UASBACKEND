<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DateTime;
use Exception;

class AdminOrderController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('status')) {
            $query->where('orders.status', $request->status);
        }

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'ilike', '%' . $keyword . '%')
                        ->orWhere('email', 'ilike', '%' . $keyword . '%');
                })
                    ->orWhere('no_order', 'ilike', '%' . $keyword . '%');;
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
                $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'ilike', '%' . $keyword . '%')
                        ->orWhere('email', 'ilike', '%' . $keyword . '%');
                })
                    ->orWhere('no_order', 'ilike', '%' . $keyword . '%');;
            });
        }

        $orders_total = $query->count();

        $status_pemesanan = [
            0 => 'Keranjang',
            1 => 'Sedang diproses',
            2 => 'Selesai'
        ];

        return view('admin.order.index', compact('orders', 'orders_total', 'status_pemesanan'));
    }

    public function detail($id)
    {
        $order = Order::orderBy('id', 'desc')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.menu')->find($order->id);


        $status_pemesanan = [
            0 => 'Keranjang',
            1 => 'Sedang diproses',
            2 => 'Selesai'
        ];

        return view('admin.order.detail', compact('order', 'status_pemesanan'));
    }

    public function ubah_status($id)
    {
        $order = Order::orderBy('id', 'desc')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order = Order::with('orderItems.menu')->find($order->id);


        $status_pemesanan = [
            0 => 'Keranjang',
            1 => 'Sedang diproses',
            2 => 'Selesai'
        ];

        return view('admin.order.ubah_status', compact('order', 'status_pemesanan'));
    }

    //update
    public function ubah_status_process(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        try {
            $status = $request->status;

            $update = [
                'status' => $status
            ];

            if ($status == 1) {
                $update["tanggal_pembayaran"] = new DateTime();
            } else if ($status == 6) {
                $update["tanggal_pengiriman"] = new DateTime();
            }

            Order::whereId($id)->update($update);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam mengubah status: ' . $e->getMessage());
        }


        return redirect()->route('admin.orders')->with('success', 'Status pesanan berhasil diubah.');
    }
}
