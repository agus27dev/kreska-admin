<?php

use App\Models\Product;
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

// disini auth berfungsi sebagai middleware atau satpam, jadi sebelum mengakses fungsi index di controller
// dashboard harus lewat auth ini dulu. Nanti di controller dashboard juga diberikan fungsu authnya dan jangan
// jangan lupa mengganti route homenya di routesservicesprovider ke '/' agar dia otomatis ke index namun lewat auth dulu
Auth::routes();
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/logout', 'DashboardController@logout');

//galeri by list
Route::get('products/{id}/gallery', 'ProductController@gallery')->name('products.gallery');

//CRUD PRODUCT
Route::resource('products', 'ProductController');

//CRUD gallery
Route::resource('product-galleries', 'ProductGalleryController');


//statustransaksi
Route::get('transactions/{id}/set-status', 'TransactionController@setStatus')->name('transactions.status');
// transaksi
Route::resource('transactions', 'TransactionController');



