<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuKategoriController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Initialize base query
        $query = Menu::query();

        // Filter by category if kategori_id is provided
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('nama', 'ILIKE', '%' . $keyword . '%');
            });
        }

        // Sorting
        $validSortColumns = ['name_asc', 'name_desc', 'price_asc', 'price_desc'];
        $sort_by = $request->input('sort_by', 'name_asc'); // Default sort by name_asc
        if (!in_array($sort_by, $validSortColumns)) {
            $sort_by = 'name_asc'; // Default to name_asc if invalid value
        }

        switch ($sort_by) {
            case 'name_asc':
                $query->orderBy('nama', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            default:
                $query->orderBy('nama', 'asc');
                break;
        }

        // Pagination with items per page
        $items_per_page = $request->input('items_per_page', 12); // Default items per page
        $menu = $query->paginate($items_per_page);


        // Total products count
        $query = Menu::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('nama', 'ILIKE', '%' . $keyword . '%');
            });
        }

        $total_menu = $query->count();

        $kategori = Menu::join('kategori', 'kategori.id', "=", "menu.kategori_id")
            ->select('kategori.id as kategori_id', 'kategori.nama as kategori_nama', DB::raw('COUNT(*) as count'))
            ->groupBy('kategori.id')
            ->get();


        if ($request->has('cari')) {
            $kategori = Kategori::select('kategori.id as kategori_id', 'kategori.nama as kategori_nama')
                ->leftJoin('menu', function ($join) use ($keyword) {
                    $join->on('kategori.id', '=', 'menu.kategori_id')
                        ->whereRaw('LOWER(menu.nama) LIKE ?', ['%' . strtolower($keyword) . '%']);
                })
                ->groupBy('kategori.id', 'kategori.nama')
                ->selectRaw('COUNT(menu.id) as count')
                ->orderBy('kategori.id')
                ->get();
        }

        return view('menu_kategori.index', compact('menu', 'kategori', 'total_menu'));
    }

    //add_to_cart
    public function add_to_cart($id)
    {
        if (!Auth::guard("customer")->check()) {
            return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');
        }

        //cek menu ada tidak
        try {
            $menu = Menu::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $customer = Auth::guard('customer')->user()->id;
        //cek jika ada order customer dengan status = 0 (cart)
        $order = Order::getCustomerCart($customer);

        // Check if an OrderItem with the menu already exists for this Order
        $orderItem = $order->orderItems()->where('menu_id', $id)->first();

        // Begin a database transaction
        DB::beginTransaction();

        if ($orderItem) {
            // jika ada order item, update jumlah
            $orderItem->jumlah += 1;
            $orderItem->save();
        } else {
            //buat order item baru
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $id,
                'jumlah' => 1,
                'harga' => $menu->harga
            ]);
        }

        // Commit the transaction
        DB::commit();

        return redirect()->back()->with('success', 'Makanan telah ditambahkan ke keranjang');
    }
}
