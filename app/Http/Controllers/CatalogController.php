<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $products = Product::query()
            ->where('stock', '!=', 0)
            ->where('status', 1)
            ->paginate(12);

        return view('user.shop', [
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        if (! $product->getRawOriginal('status')) {
            abort(404);
        }

        return view('user.shop-details', [
            'product' => $product
        ]);
    }
}
