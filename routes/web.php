<?php

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

Route::get('/', [\App\Http\Controllers\GoodController::class, 'index']);
Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store']);
Route::get('/category/{id}', [\App\Http\Controllers\GoodController::class, 'category'])->name('category');
Route::post('/filter', [\App\Http\Controllers\GoodController::class, 'filter'])->name('filter');

