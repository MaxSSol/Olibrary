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
Route::get('/books', '\App\Http\Controllers\BookController@index')->name('books');
Route::post('/books', '\App\Http\Controllers\BookController@index')->name('books');
Route::get('/categories', '\App\Http\Controllers\CategoryController@index')->name('categories');
