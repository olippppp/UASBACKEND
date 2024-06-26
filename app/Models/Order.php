<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_order',
        'meja_id',
        'customer_id',
        'tanggal_pemesanan',
        'tanggal_pembayaran',
        'total',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $table = 'orders';

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id', 'id');
    }

    public static function getCustomerCart($customer)
    {
        $status = 0;

        // Check jika ada cart pengguna atau tidak
        $cart = Order::where('customer_id', $customer)->where('status', 0)->first();

        if (!$cart) {
            // jika tidak ada cart -> buat cart baru
            $no_order = Str::random(8);

            $cart = Order::create([
                'no_order' => $no_order,
                'customer_id' => $customer,
                'status' => $status,
                'total' => 0
            ]);
        }

        return $cart;
    }
}
