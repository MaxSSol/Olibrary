<?php

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

Route::get('/', '\App\Http\Controllers\MainController@index')->name('home');
Route::get('/categories', '\App\Http\Controllers\CategoryController@index')->name('categories');
Route::name('books.')->group(function() {
    Route::get('/books', '\App\Http\Controllers\BookController@index')->name('books');
    Route::get('/book/{id}', '\App\Http\Controllers\BookController@show')->name('show')->middleware('auth');
    Route::get('/favorite', '\App\Http\Controllers\FavoriteController@addToFavorite')->name('favorite')->middleware('auth');
    Route::get('/remove-favorite', '\App\Http\Controllers\FavoriteController@removeFromFavorite')->name('remove.favorite')->middleware('auth');
});
Route::name('auth.')->group(function() {
    Route::get('/login', '\App\Http\Controllers\LoginController@index')->name('login');
    Route::post('/login', '\App\Http\Controllers\LoginController@login');
    Route::get('/logout', '\App\Http\Controllers\LoginController@logout')->name('logout');
    Route::get(
        '/registration',
        '\App\Http\Controllers\RegistrationController@index'
    )->name('registration');
    Route::post('/registration', '\App\Http\Controllers\RegistrationController@save');
    Route::get('/account', '\App\Http\Controllers\AccountController@index')->middleware('auth')->name('account');
});

