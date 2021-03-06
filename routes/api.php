<?php

use App\Http\Controllers\JornalistaController;
use App\Http\Controllers\NoticiaController;
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
    Route::post('/login', 'login');
    Route::post('/register', 'store');
});

Route::middleware(\App\Http\Middleware\API\ProtecedRouteAuth::class)->group(function () {
    Route::controller(JornalistaController::class)->group(function () {
        Route::get('/me', 'me');
    });

    Route::prefix('type')->controller(NoticiaTipoController::class)->group(function () {
        Route::get('/me', 'show');
        Route::post('/create', 'store');
        Route::post('/update/{type_id}', 'update');
        Route::post('/delete/{type_id}', 'destroy');
    });

    Route::prefix('news')->controller(NoticiaController::class)->group(function () {
        Route::get('/me', 'show');
        Route::post('/create', 'store');
        Route::post('/update/{type_id}', 'update');
        Route::post('/delete/{type_id}', 'destroy');
    });
});
