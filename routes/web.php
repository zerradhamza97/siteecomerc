<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Editor\EditorController;

use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;



Route::get('/', [StoreController::class, 'index'])->name('home_page');
Route::get('/products/product/details/{id}', [ProductController::class, 'show'])->name('product.details');
//Route::get('/products/details', [StoreController::class, 'show'])->name('show.products.details');

Route::post('/wishlist/add',[WishlistController::class,'addTo_wishlist'])->name('wishlist.add');

//admin
Route::middleware(['admin'])->group(function () {
    route::resource('categories',CategoryController::class);
    route::resource('products',ProductController::class);
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
});

//editor
Route::middleware(['editor'])->group(function () {
    Route::get('/editor/dashboard', [EditorController::class, 'index'])->name('editor_dashboard');

});

require __DIR__.'/auth.php';

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
