<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart; // Assuming you have a Cart model
use App\Models\Order;

class CartItemCountMiddleware
{
    public function handle($request, Closure $next)
    {
        $cartItemCount = 0;
        if (auth()->guard('customer')->check()) {
            $customerId = auth()->guard('customer')->user()->id;
            $cart = Order::where('customer_id', $customerId)->where('status', 0)->first();

            if ($cart != null && $cart->id) {
                $cartItemCount = $cart->orderItems()->count();
            }
        } else {
            $cartItemCount = 0;
        }

        // Share $cartItemCount with all views
        view()->share('cartItemCount', $cartItemCount);

        return $next($request);
    }
}
