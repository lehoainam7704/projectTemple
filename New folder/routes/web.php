<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartLastController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Categori;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

Paginator::useBootstrap();
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

Route::get('/{page?}',[HomeController::class,'index']);
Route::get('/single-product/{product}',[HomeController::class,'product'])->name('single.product');
Route::get('/latest-product/{latestproducts}',[HomeController::class,'latestproducts'])->name('latest.product');
Route::get('/category-product/{categoryproducts}',[HomeController::class,'categoryproducts'])->name('category');
Route::get('/product-category/{productcategory}',[HomeController::class,'productcategory'])->name('product.category');
Route::get('/topsellers-product/{topselersproducts}',[HomeController::class,'topselersproducts'])->name('topsellers.product');
Route::get('/search-product/{searchproduct}',[HomeController::class,'searchproduct'])->name('timkiem.product');
Route::post('/cart/{add}',[CartController::class,'add'])->name('cart.add');
Route::get('/cart/{listproduct}',[CartController::class,'listproduct'])->name('cart.product');

Route::post('/cart/{addlast}',[CartLastController::class,'addlast'])->name('cart.addlast');
Route::get('/cart/{listlastproduct}',[CartLastController::class,'listlastproduct'])->name('cart.lastproduct');


//Admin
Route::middleware('auth')->group(function  () {
    Route::resource("/admin_product", ProductController::class);
    Route::get('/admin_product',function(){
        return view('admin_product.index');
    });
    Route::get('/admin_product', [ProductController::class, 'store'])->name('admin_product.store');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/logo-product/{logoproduct}',[HomeController::class,'logoproduct'])->name('logo.product');
require __DIR__.'/auth.php';
