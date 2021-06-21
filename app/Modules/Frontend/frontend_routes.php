<?php

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

$app = function () {
    Route::get('/', function () {
        dd('masuk');
    });
};

if (env('APP_ENV') == 'local' || env('APP_ENV') == null) {
    $app();
} else {
    Route::domain(env('APP_URL'))->group(function () use ($app) {
        $app();
    });
}
