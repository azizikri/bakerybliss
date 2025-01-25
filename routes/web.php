<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CartController,
    HomeController,
    AboutUsController,
    AccountController,
    AddressController,
    CatalogController,
    ContactController,
    ProfileController,
    TransactionController
};

// Public routes
Route::get('/', HomeController::class)->name('home');
Route::get('/about-us', AboutUsController::class)->name('about-us');
Route::get('/contact', ContactController::class)->name('contact');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Catalog protected routes
    Route::get('/catalog/detail/{product}', [CatalogController::class, 'show'])->name('catalog.show');

    // Shopping cart
    Route::prefix('cart')->group(function () {
        Route::get('/', CartController::class)->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    });

    // Resource routes
    Route::resources([
        'addresses' => AddressController::class,
        'accounts' => AccountController::class,
        'transactions' => TransactionController::class,
    ]);
});

require __DIR__.'/auth.php';
