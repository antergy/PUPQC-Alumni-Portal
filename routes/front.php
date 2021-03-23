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

$aVueRoutes = [
    '/',
    '/home'
];
foreach ($aVueRoutes as $sRoute) {
    Route::get($sRoute, function () use ($sRoute) {
        $aSession = \App\Libraries\Common\AuthLib::getUserSession();
        $aSessionStatus = data_get($aSession, 'user_session_active', null);
        if ($aSessionStatus === null) {
            if ($sRoute === '/') {
                return view('main');
            } else {
                return redirect('/');
            }
        } else {
            if ($sRoute === '/') {
                return redirect('/home');
            } else {
                return view('main');
            }
        }
    })->where('any', '.*');
}

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::get('/getSession', 'AuthController@getSession');
