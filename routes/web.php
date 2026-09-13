<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    $products = Product::where('featured', true)
        ->latest()
        ->get();

    return view('welcome', compact('products'));
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add']);
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index']);
Route::post("/cart/update/{id}", [App\Http\Controllers\CartController::class, "update"]);
Route::delete('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove']);

Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index']);
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store']);

Route::get('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout']);

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);

Route::get('/admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->middleware('admin');
Route::get('/admin/orders/{id}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->middleware('admin');
Route::post('/admin/orders/{id}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->middleware('admin');

Route::get('/admin/products', [\App\Http\Controllers\AdminProductController::class, 'index'])->middleware('admin');
Route::get('/admin/products/create', [\App\Http\Controllers\AdminProductController::class, 'create'])->middleware('admin');
Route::post('/admin/products', [\App\Http\Controllers\AdminProductController::class, 'store'])->middleware('admin');
Route::get('/admin/products/{id}/edit', [\App\Http\Controllers\AdminProductController::class, 'edit'])->middleware('admin');
Route::post("/admin/products/{id}/add-stock", [\App\Http\Controllers\AdminProductController::class, "addStock"])->middleware("admin");
Route::put('/admin/products/{id}', [\App\Http\Controllers\AdminProductController::class, 'update'])->middleware('admin');
Route::delete('/admin/products/{id}', [\App\Http\Controllers\AdminProductController::class, 'destroy'])->middleware('admin');
