<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use League\Flysystem\PathPrefixer;

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
    Route::get('get', [KategoriController::class, 'getAllData']);
    Route::post('create', [KategoriController::class, 'createData']);
    Route::get('edit/{id}', [KategoriController::class, 'getDataById']);
    Route::post('update/{id}', [KategoriController::class, 'updateData']);
    Route::delete('delete/{id}', [KategoriController::class, 'deleteData']);
});
Route::prefix('v2')->group(function(){
    Route::get('get', [TransaksiController::class, 'getAllData']);
    Route::post('create', [TransaksiController::class, 'createData']);
    Route::get('edit/{id}', [TransaksiController::class, 'getDataById']);
    Route::post('update/{id}', [TransaksiController::class, 'updateData']);
    Route::delete('delete/{id}', [TransaksiController::class, 'deleteData']);
});
