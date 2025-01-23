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
        $popularProducts = cache()->remember('popular_products', now()->addDay(), function () {
            return Product::query()
                ->withCount('transactions')
                ->orderBy('transactions_count', 'desc')
                ->limit(5)
                ->get();
        });

        $usedTags = cache()->remember('usedTags', now()->addDay(), function () {
            return Product::query()
                ->select('tags')
                ->distinct()
                ->get()
                ->pluck('tags')
                ->flatten()
                ->unique();
        });

        $tags = cache()->remember('tags', now()->addDay(), function () {
            return Tag::query()->get('name');
        });

        $firstTagProducts = cache()->remember('first_tag_products', now()->addDay(), function () use ($usedTags) {
            if ($usedTags->isEmpty()) {
                return Product::query()->limit(8)->get();
            }

            return Product::query()
                ->whereRelation('tags', 'name', $usedTags->first()->name)
                ->limit(8)
                ->get();
        });

        return view('user.index', [
            'popularProducts' => $popularProducts,
            'usedTags' => $usedTags,
            'tags' => $tags,
            'firstTagProducts' => $firstTagProducts,
        ]);
    }
}
