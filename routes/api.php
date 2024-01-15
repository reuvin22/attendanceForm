<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AttendanceController;
use App\Http\Controllers\Api\v1\LoginController;
use App\Http\Controllers\Api\v1\RegisterController;

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

Route::apiResource('/attendance', AttendanceController::class);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/admin', [RegisterController::class, 'store']);
Route::middleware('auth:sanctum')->group(function(){

});
