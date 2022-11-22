<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::model('product', 'Product');

Route::get('/billing', [ProductController::class, 'show'])->name('product.show');

Route::get('/list/{email}',[PurchaseController::class,'view_purchase'])->name('purchaselist');

Route::resource('purchase', PurchaseController::class);