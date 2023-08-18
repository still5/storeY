<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/welcome', function () {
    return view('welcome');
});
//Route::view('/', 'products')->name('home');
Route::view('/auth', 'login')->name('login');
Route::view('/admin', 'admin');
Route::view('/404', '404');
Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('home');

Route::get('/order', [\App\Http\Controllers\OrderController::class, 'processOrder'])->name('orders.create');
Route::post('/order', [\App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::get('/order/created', [\App\Http\Controllers\OrderController::class, 'created'])->name('orders.created');
Route::get('/order/edit/{orderId}', [\App\Http\Controllers\OrderController::class, 'getOrderForUpdate'])->name('orders.edit');
Route::post('/order/edit/{orderId}', [\App\Http\Controllers\OrderController::class, 'updateOrder'])->name('orders.update');
Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');

Route::get('/product/{productId}', [\App\Http\Controllers\ProductController::class, 'showProduct'])->name('products.view');
Route::get('/product', [\App\Http\Controllers\ProductController::class, 'createPage'])->name('products.create');
Route::post('/product', [\App\Http\Controllers\ProductController::class, 'createProduct'])->name('products.save');
Route::get('/product/edit/{productId}', [\App\Http\Controllers\ProductController::class, 'getProductForUpdate'])->name('products.edit');
Route::post('/product/edit/{productId}', [\App\Http\Controllers\ProductController::class, 'updateProduct'])->name('products.update');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::post('/product/{productId}', [\App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');

require __DIR__.'/auth.php';
