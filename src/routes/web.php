<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', 'App\Http\Controllers\ProductController@index')->name('products.index');

Route::resource('/products', 'App\Http\Controllers\ProductController')->except(['index', 'show'])->middleware('auth');

Route::resource('/products', 'App\Http\Controllers\ProductController')->only('show');

Route::prefix('products')->name('products.')->group(function () {
    Route::put('/{product}/like', 'App\Http\Controllers\ProductController@like')->name('like')->middleware('auth');
    Route::delete('/{product}/like', 'App\Http\Controllers\ProductController@unlike')->name('unlike')->middleware('auth');
});

Route::prefix('users')->name('users.')->group(function(){
    // タブ
    Route::get('/{name}', 'App\Http\Controllers\UserController@show')->name('show');
    Route::get('/{name}/likes', 'App\Http\Controllers\UserController@likes')->name('likes');

    Route::get('/{name}/followings', 'App\Http\Controllers\UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'App\Http\Controllers\UserController@followers')->name('followers');

    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'App\Http\Controllers\UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'App\Http\Controllers\UserController@unfollow')->name('unfollow');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
