<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::middleware(['auth.redirect'])->group(function () {
    // routes that require authentication
    Route::get('/', function () {
        return view('main.home');
    })->name('home');

    Route::get('/tag', function () {
        return view('main.tag');
    })->name('tag');
});