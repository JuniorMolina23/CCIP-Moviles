<?php

use App\Http\Requests\LoginRequest;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[\App\Http\Controllers\ApiController::class,'login']);
Route::post('/traslado',[\App\Http\Controllers\ApiController::class,'traslado']);
Route::post('/saldo',[\App\Http\Controllers\ApiController::class,'saldo']);
Route::post('/combustible',[\App\Http\Controllers\ApiController::class,'combustible']);
Route::post('/peaje',[\App\Http\Controllers\ApiController::class,'peaje']);
Route::post('/otros',[\App\Http\Controllers\ApiController::class,'otros']);
