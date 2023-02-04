<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

Route::get('/v1/', [\App\Http\Controllers\V1Controller::class, 'show'])
    ->name('v1.show');

Route::post('/v1', [\App\Http\Controllers\V1Controller::class, 'store'])
    ->name('v1.store');

Route::get('/v2/', [\App\Http\Controllers\V2Controller::class, 'show'])
    ->name('v2.show');

Route::post('/v2', [\App\Http\Controllers\V2Controller::class, 'store'])
    ->name('v2.store');

Route::get('/v2/token/store', [\App\Http\Controllers\V2Controller::class, 'tokenstore'])
    ->name('v2.token.store');
