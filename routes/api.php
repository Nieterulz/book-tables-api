<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TableController;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('tables')->group(function () {
    Route::post('/', [TableController::class, 'store']);
    Route::get('/availability', [TableController::class, 'availability']);
    Route::delete('/{code}', [TableController::class, 'destroy']);
});

Route::prefix('bookings')->group(function () {
    Route::post('/', [BookingController::class, 'store']);
    Route::delete('/{code}', [BookingController::class, 'destroy']);
});
