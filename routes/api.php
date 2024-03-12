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
Route::post('/inser-order', [App\Http\Controllers\OrderController::class, 'insertOrder'])->name('insert.order');
Route::get('/order-insert-form', [App\Http\Controllers\OrderController::class, 'showOrderInsertForm'])->name('order.insert.form');
Route::get('/csv-insert-form', [App\Http\Controllers\OrderController::class, 'showcsvInsertForm'])->name('csv.insert.form');