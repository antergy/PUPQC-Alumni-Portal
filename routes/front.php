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

// Add an appropriate middleware for API @TODO
//
//Route::get('/', 'HomePageController@viewMainPage');
////Route::post('/login', 'LoginPageController@login');
////Route::post('/register', 'RegistrationPageController@register');
//Route::get('/vue/{vue_capture?}', function () {
//    return view('vue.index');
//   })->where('vue_capture', '[\/\w\.-]*');


Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');

Route::get('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/testSession', 'AuthController@testSession');
