<?php

use App\Http\Controllers\api\ApiAdminController;
use App\Http\Controllers\api\ApiAuthController;
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

Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ApiAuthController::class)->group(function (){
        Route::get('/logout','logout');
        Route::get('/me','me');
    });

    Route::controller(ApiAdminController::class)->group(function (){
        Route::get('/information','information');
    });

});