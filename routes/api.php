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


Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ApiAuthController::class)->group(function (){
        Route::get('/logout','logout');
        Route::get('/me','me');
    });

    Route::controller(ApiAdminController::class)->group(function (){
        Route::get('/information','information');
        Route::post('/pendaftaran','pendaftaran');
        Route::get('/nilai_ujian','nilai_ujian');
        Route::get('/nilai_lpk','nilai_lpk');
        Route::post('/input_nilai_lpk','input_nilai_lpk');
        Route::put('/update_nilai_lpk/{id}','update_nilai_lpk');
        Route::delete('/delete_nilai_lpk/{id}','delete_nilai_lpk');
        Route::get('/jadwal','jadwal');
    });

});
