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
     * API Route group for account management
     */
    Route::prefix('account')->group(function ()  {
        Route::get('read', "AccountApiController@getAll");
        Route::post('create', "AccountApiController@create");
        Route::post('update', "AccountApiController@update");
        Route::post('delete', "AccountApiController@delete");
    });

    /**
     * API Route group for visit logs management
     */
    Route::prefix('visit_logs')->group(function ()  {
        Route::get('read', "VisitLogsApiController@getAll");
        Route::post('create', "VisitLogsApiController@create");
    });

    /**
     * API Route group for message / inboxes management
     */
    Route::prefix('message')->group(function ()  {
        Route::get('read', "InboxesApiController@getAll");
        Route::post('create', "InboxesApiController@create");
        Route::post('delete', "InboxesApiController@delete");
    });

    /**
     * API Route group for post management
     * - Includes likes and comments management
     */
    Route::prefix('posts')->group(function () {
        $sParentNamespace = 'Post_Management';

        Route::get('read', "{$sParentNamespace}\PostApiController@getAll");
        Route::post('create', "{$sParentNamespace}\PostApiController@create");
        Route::post('update', "{$sParentNamespace}\PostApiController@update");
        Route::post('delete', "{$sParentNamespace}\PostApiController@delete");

        Route::prefix('likes')->group(function () use ($sParentNamespace) {
            Route::get('count', "{$sParentNamespace}\LikeApiController@getCount");
            Route::get('read', "{$sParentNamespace}\LikeApiController@getAll");
            Route::post('create', "{$sParentNamespace}\LikeApiController@create");
            Route::post('update', "{$sParentNamespace}\LikeApiController@update");
            Route::post('deleteByPost', "{$sParentNamespace}\LikeApiController@bulkDelete");
        });

        Route::prefix('comments')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\CommentApiController@getAll");
            Route::post('create', "{$sParentNamespace}\CommentApiController@create");
            Route::post('update', "{$sParentNamespace}\CommentApiController@update");
            Route::post('delete', "{$sParentNamespace}\CommentApiController@delete");
            Route::post('deleteByPost', "{$sParentNamespace}\CommentApiController@bulkDelete");
        });
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
