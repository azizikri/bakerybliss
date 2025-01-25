<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __invoke()
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $delivery = 20000;
        $total = $subtotal + $delivery;

        return view('user.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'delivery' => $delivery,
            'total' => $total,
        ]);
    }

    public function addToCart(Product $product)
    {
        if (! $product) {
            return redirect()->route('catalog.index')->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['subtotal'] = $product->price * $cart[$product->id]['quantity'];
        } else {
            $cart[$product->id] = [
                'thumbnail' => $product->thumbnail,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'subtotal' => $product->price
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('catalog.index')->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            // Recalculate subtotal
            $cart[$request->id]["subtotal"] = $cart[$request->id]["price"] * $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => 'Cart updated successfully']);
        }
        return response()->json(['error' => 'Update failed'], 404);
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                return response()->json(['success' => 'Product removed from cart']);
            }
        }
        return response()->json(['error' => 'Remove failed'], 404);
    }
}
