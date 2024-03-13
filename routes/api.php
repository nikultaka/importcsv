<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/import-csv', [App\Http\Controllers\OrderController::class, 'importCsv'])->name('import.csv');
Route::post('/insert-order', [App\Http\Controllers\OrderController::class, 'insertOrder'])->name('insert.order');

Route::get('/csv-insert-form', function () {
    return view('welcome');
})->name('csv.insert.form');

Route::get('/order-insert-form', function () {
    return view('orderinsert');
})->name('order.insert.form');