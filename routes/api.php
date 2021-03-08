<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('poe')->group(function () {
        Route::get('leagues', [App\Http\Controllers\api\PoeController::class, 'leagues']);
        Route::get('ladders/{id}', [App\Http\Controllers\api\PoeController::class, 'ladders']);
        Route::get('character', [App\Http\Controllers\api\PoeController::class, 'character']);
        Route::get('currencyOverview', [App\Http\Controllers\api\PoeController::class, 'currencyOverview']);
    });
});
