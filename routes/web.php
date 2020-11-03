<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
Route::get('/', 'App\Http\Controllers\DashboardController@home')->name('welcome');
Route::get('product/{slug}', 'App\Http\Controllers\ProductController@show')->name('products.read');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::middleware(['is_admin'])->group(function () {
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('categories', CategoryController::class)->except('show');
    });
});
Route::get('/products/{slug}', 'App\Http\Controllers\DashboardController@productList')->name('productList');
