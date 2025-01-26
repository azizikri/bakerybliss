<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
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
            'addresses' => auth()->user()->addresses,
            'accounts' => auth()->user()->accounts()->with('bank')->get(),
            'methods' => Transaction::DELIVERY_METHODS
        ]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'thumbnail' => $product->thumbnail,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $product->price * $quantity
            ];
        }

        $cart[$product->id]['subtotal'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity'];

        session()->put('cart', $cart);

        $response = [
            'message' => 'Product added to cart successfully!',
            'cartCount' => count($cart)
        ];

        return $request->ajax()
            ? response()->json($response)
            : redirect()->back()->with($response);
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
