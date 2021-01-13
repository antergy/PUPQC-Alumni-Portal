<?php

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

// Add an appropriate middleware for API @TODO

Route::prefix('v1')->group(function () {

    /**
     * API Route group for post management
     */
    Route::prefix('posts')->group(function () {
        Route::get('test', 'PostApiController@test');
    });

    /**
     * Set the API route group for the following sub-modules in system admin:
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
    $aModules = [
        'course'          => 'CourseApiController',
        'acc_type'        => 'AccountTypeApiController',
        'post_type'       => 'PostTypeApiController',
        'educ_attain'     => 'EducAttainApiController',
        'honors'          => 'HonorsReceivedApiController',
        'profex'          => 'ProfessionalExamApiController',
        'fjtf'            => 'FirstJobTimeframeApiController',
        'fjd'             => 'FirstJobDiscoverApiController',
        'job_level'       => 'JobLevelApiController',
        'se_salary'       => 'SelfEmployedSalaryApiController',
        'unemploy_reason' => 'UnemploymentReasonApiController',
        'industry'        => 'IndustryApiController',
        'competency'      => 'CompetencyApiController',
        'ioe'             => 'ImpactEducationApiController'
    ];
    foreach ($aModules as $sModuleGroupName => $sModuleController) {
        Route::prefix($sModuleGroupName)->group(function () use($sModuleController) {
            Route::get('read', "{$sModuleController}@getAll");
            Route::post('create', "{$sModuleController}@create");
            Route::post('update', "{$sModuleController}@update");
            Route::post('delete', "{$sModuleController}@delete");
        });
    }

});
