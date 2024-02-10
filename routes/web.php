<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'index_product']);
Route::get('/get-data/{id}', [ProductController::class, 'getData']);
Route::post('/store-product', [ProductController::class, 'store_product'])->name('store-product');
Route::post('/update-data', [ProductController::class, 'updateData']);
Route::post('/destroy', [ProductController::class, 'destroy_product']);