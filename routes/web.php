<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;

// ===== CUSTOMER ROUTES =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{slug}', [ShopController::class, 'show'])->name('show');
});

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::patch('/update/{product}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{product}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

// Checkout (require auth)
Route::middleware(['auth'])->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
});

// Account (placeholder - will implement later)
Route::middleware(['auth'])->prefix('account')->name('account.')->group(function () {
    Route::get('/orders', function() {
        return view('customer.account.orders');
    })->name('orders');
    
    Route::get('/profile', function() {
        return view('customer.account.profile');
    })->name('profile');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'products' => \App\Models\Product::count(),
            'categories' => \App\Models\Category::count(),
            'regions' => \App\Models\Region::count(),
            'orders' => 0
        ];
        return view('dashboard', compact('stats'));
    })->name('admin.dashboard');

    // Region routes
    Route::resource('regions', RegionController::class);
    
    // Category routes
    Route::resource('categories', CategoryController::class);
    
    // Product routes
    Route::resource('products', ProductController::class);
    
    // Delete product image
    Route::delete('products/images/{image}', [ProductController::class, 'deleteImage'])
        ->name('products.images.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';