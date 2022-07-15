<?php

use App\Http\Controllers\JornalistaController;
use App\Http\Controllers\NoticiaTipoController;
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

Route::controller(JornalistaController::class)->group(function () {
    Route::get('/register', 'show');
    Route::get('/login', 'show');
    Route::get('/me', 'show');
});


Route::prefix('type')->controller(NoticiaTipoController::class)->group(function () {
    Route::get('/me', 'show');
    Route::post('/create', 'store');
    Route::post('/update/{type_id}', 'update');
    Route::post('/delete/{type_id}', 'destroy');
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
