<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Add an appropriate middleware for API @TODO

Route::prefix('admin')->group(function () {

    /**
     * Admin route group for post management
     */
    Route::prefix('posts')->group(function () {
        Route::get('test', 'PostAdminController@test');
    });

});
