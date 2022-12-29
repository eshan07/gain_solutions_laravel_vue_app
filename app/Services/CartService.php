<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Arr;

class CartService
{
    public function store($request)
    {
        $product = findBySlug(Product::class, $request->slug);
        $cart = Cart::firstOrCreate([
            'item_id' => $product->id
        ], [
            'quantity' => $request->quantity,
        ]);
        if (!$cart->wasRecentlyCreated){
            $cart->quantity += $request->quantity;
            $cart->update();
        }
        return $cart;
    }
}
