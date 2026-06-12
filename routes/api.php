<?php

use App\Http\Controllers\Api\akunController;
use App\Http\Controllers\api\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource("/user", akunController::class);
Route::apiResource("/kategori", KategoriController::class);

