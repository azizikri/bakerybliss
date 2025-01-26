<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $popularProducts = Product::query()
            ->withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->where('status', 1)
            ->where('stock', '>', 0)
            ->limit(5)
            ->get();


        $usedTags = Product::query()
            ->select('tags')
            ->distinct()
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique();

        $tags = Tag::query()->get('name');

        $firstTagProducts = $usedTags->isEmpty() ? Product::query()->limit(8)->get() : Product::query()
            ->whereRelation('tags', 'name', $usedTags->first()->name)
            ->where('status', 1)
            ->where('stock', '>', 0)
            ->limit(8)
            ->get();

        return view('user.index', [
            'popularProducts' => $popularProducts,
            'usedTags' => $usedTags,
            'tags' => $tags,
            'firstTagProducts' => $firstTagProducts,
        ]);
    }
}
