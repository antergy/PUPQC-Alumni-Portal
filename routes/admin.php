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

    /**
     * Set the Admin route group for the following sub-modules
     * in system admin under system route group:
     *
     * - Course Management
     * - Account Type Management
     * - Post Type Management
     * - Educational Attainment Management
     * - Honors Received Management
     * - Professional Exam Management
     * - First Job Timeframe Management
     * - First Job Discover Management
     * - Job Level Management
     * - Self Employed Salary Management
     * - Unemployment Reason Management
     * - Industry Management
     * - Competency Management
     * - Impact of Education Management
     */
    Route::prefix('system')->group(function () {
        $aModules = [
            'course',
            'acc_type',
            'post_type',
            'educ_attain',
            'honors',
            'profex',
            'fjtf',
            'fjd',
            'job_level',
            'se_salary',
            'unemploy_reason',
            'industry',
            'competency',
            'ioe'
        ];
        foreach ($aModules as $sModule) {
            Route::prefix($sModule)->group(function () {
                Route::get('read', 'SystemAdminController@manageRequest');
                Route::get('create', 'SystemAdminController@manageRequest');
                Route::get('update', 'SystemAdminController@manageRequest');
                Route::get('delete', 'SystemAdminController@manageRequest');
            });
        }
    });
});
