<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::inRandomOrder()->limit(5)->get('name');

        return view('user.about', [
            'products' => $products
        ]);
    }
}
