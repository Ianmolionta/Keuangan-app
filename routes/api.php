<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
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
Route::prefix('v1')->group(function(){
    Route::get('/', [TransaksiController::class, 'getAllData']);
    Route::post('/create', [TransaksiController::class, 'createData']);
    Route::get('/get/{id}', [TransaksiController::class, 'getDataById']);
    Route::post('/update/{id}', [TransaksiController::class, 'updateData']);
    Route::delete('/delete/{id}', [TransaksiController::class, 'deleteData']);
});
Route::prefix('v2')->group(function(){
    Route::get('/', [LaporanController::class, 'getAllData']);
    Route::post('/create', [LaporanController::class, 'createData']);
    Route::get('/get/{id}', [LaporanController::class, 'getDataById']);
    Route::post('/update/{id}', [LaporanController::class, 'updateData']);
    Route::delete('/delete/{id}', [LaporanController::class, 'deleteData']);
});
