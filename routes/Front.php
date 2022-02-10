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

/** NOTE: It is important that the vue routes are different from the web routes */
$aAuthenticatedVueRoutes = [
    '/',
    '/home',
    '/admin/accounts',
    '/admin/tracerForm',
    '/admin/sysconfig/acc_entities',
    '/admin/sysconfig/sys_entities',
    '/admin/sysconfig/form/basic',
    '/admin/sysconfig/form/questions',
    '/admin/reports/posts',
    '/admin/reports/tracer',
    '/admin/reports/logs',
    '/message/create',
    '/message/inbox',
    '/message/sent',
    '/message/sent/details',
    '/message/inbox/details'
];
foreach ($aAuthenticatedVueRoutes as $sRoute) {
    Route::get($sRoute, function () use ($sRoute) {
        /** Retrieve session from backend */
        $aSession = \App\Libraries\Common\AuthLib::getUserSession();
        $aSessionStatus = data_get($aSession, 'user_session_active', null);

        /** Condition to check if session is active or not */
        if ($aSessionStatus === null) {
            if ($sRoute === '/') { // If the session is dead and attempts to go to main home page or other page
                return view('main');
            } else {
                return redirect('/');
            }
        } else { // If the session is active and attempted to return to login page
            if ($sRoute === '/') {
                return redirect('/home');
            } else {
                return view('main');
            }
        }
    })->where('any', '.*');
}

$aPublicVueRoutes = [
  '/register',
  '/tracerIntro',
  '/tracerForm/{id}',
  '/tracerForm/answer/{id}',
  '/ug_tracerForm'
];
foreach ($aPublicVueRoutes as $sRoute) {
    Route::get($sRoute, function () use ($sRoute) {
        return view('main');
    })->where('any', '.*');
}

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/alumni/account/create', 'RegistrationPageController@register');
Route::get('/getSession', 'AuthController@getSession');

