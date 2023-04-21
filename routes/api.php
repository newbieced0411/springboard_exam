<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/register', 'new');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/show/{user}', 'show');
        Route::patch('/edit/{user}', 'update');
    });

    Route::controller(BranchController::class)->prefix('branch')->group(function () {
        Route::get('/', 'index');
        Route::post('/add', 'new');
        Route::patch('/edit/{branch}', 'edit');
        Route::post('/remove/{branch}', 'remove');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('/', 'index');
        Route::post('/{branch}/add', 'new');
        Route::patch('/edit/{product}', 'edit');
        Route::post('/remove/{product}', 'remove');
    });
});