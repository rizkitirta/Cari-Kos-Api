<?php

use App\Http\Controllers\KosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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


Route::post('/v1/login', [LoginController::class, 'index'])->name('login');

Route::post('/v1/register', [RegisterController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum','prefix' => 'v1'], function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/user', [UserController::class, 'index']);

    Route::resource('kos', KosController::class);
});

