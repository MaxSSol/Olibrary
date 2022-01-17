<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', '\App\Http\Controllers\MainController@index')
    ->name('home');

Route::get('/categories', '\App\Http\Controllers\CategoryController@index')
    ->name('categories');

Route::name('books.')->group(function () {
    Route::get('/books', '\App\Http\Controllers\BookController@index')
        ->name('books');
    Route::get('/book/show/{id}', '\App\Http\Controllers\BookController@show')
        ->name('show')
        ->middleware('auth');
    Route::get('/favorite', '\App\Http\Controllers\FavoriteController@addToFavorite')
        ->name('favorite')
        ->middleware('auth');
    Route::get('/remove-favorite', '\App\Http\Controllers\FavoriteController@removeFromFavorite')
        ->name('remove.favorite')
        ->middleware('auth');
    Route::get('/book/download/{id}', '\App\Http\Controllers\BookDownloadController@download')
        ->name('download')
        ->middleware('auth');
});

Route::name('auth.')->group(function () {
    Route::get('/login', '\App\Http\Controllers\LoginController@index')
        ->name('login');
    Route::post('/login', '\App\Http\Controllers\LoginController@login');
    Route::get('/logout', '\App\Http\Controllers\LoginController@logout')
        ->name('logout');
    Route::get(
        '/registration',
        '\App\Http\Controllers\RegistrationController@index'
    )->name('registration');
    Route::post('/registration', '\App\Http\Controllers\RegistrationController@store');
});

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', '\App\Http\Controllers\ResetPasswordController@show')
        ->name('password.request');
    Route::post('/forgot-password', '\App\Http\Controllers\ResetPasswordController@sendEmail')
        ->name('password.email');
    Route::get('/reset-password/{token}', '\App\Http\Controllers\ResetPasswordController@edit')
        ->name('password.reset');
    Route::post('/reset-password', '\App\Http\Controllers\ResetPasswordController@update')
        ->name('password.update');
});

Route::group(['prefix' => 'email'], function () {
    Route::get('/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/account');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::middleware('auth')->name('account.')->group(function () {
    Route::get('/account', '\App\Http\Controllers\AccountController@index')
        ->name('account');
    Route::get(
        '/account/settings',
        '\App\Http\Controllers\AccountController@changeCredentials'
    )->name('settings');
    Route::post(
        '/account/settings',
        '\App\Http\Controllers\AccountController@changeCredentials'
    );
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@index')
        ->name('dashboard');

    //user

    Route::get('/user/edit/{id}', '\App\Http\Controllers\UserController@edit')
        ->name('user.edit');
    Route::post('/user/update/{id}', '\App\Http\Controllers\UserController@update')
        ->name('user.update');
    Route::get('/user/ban', '\App\Http\Controllers\UserController@ban')
        ->name('user.ban');
    Route::get('/user/unban', '\App\Http\Controllers\UserController@unban')
        ->name('user.unban');

    //books

    Route::get('/book/create', '\App\Http\Controllers\BookController@create')
        ->name('book.create');
    Route::post('/book/create', '\App\Http\Controllers\BookController@store')
        ->name('book.store');
    Route::get('/book/update/{id}', '\App\Http\Controllers\BookController@edit')
        ->name('book.edit');
    Route::post('/book/update/{id}', '\App\Http\Controllers\BookController@update')
        ->name('book.update');
    Route::post('/book/delete', '\App\Http\Controllers\BookController@destroy')
        ->name('book.delete');

    //authors

    Route::get('/author/create', '\App\Http\Controllers\AuthorController@create')
        ->name('author.create');
    Route::post('/author/create', '\App\Http\Controllers\AuthorController@store')
        ->name('author.store');
    Route::get('/author/update/{id}', '\App\Http\Controllers\AuthorController@edit')
        ->name('author.edit');
    Route::post('/author/update/{id}', '\App\Http\Controllers\AuthorController@update')
        ->name('author.update');
    Route::get('/author/delete/{id}', '\App\Http\Controllers\AuthorController@delete')
        ->name('author.delete');
});

