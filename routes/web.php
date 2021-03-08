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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('poe')->group(function () {
            Route::get('leagues', [App\Http\Controllers\api\PoeController::class, 'leagues']);
            Route::get('ladders/{id}', [App\Http\Controllers\api\PoeController::class, 'ladders']);
            Route::get('character', [App\Http\Controllers\api\PoeController::class, 'character']);
            Route::get('currencyOverview', [App\Http\Controllers\api\PoeController::class, 'currencyOverview']);
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ladders', function () {
    return view('ladders');
})->name('ladders');

Route::get('/character', function () {
    return view('character');
})->name('character');
