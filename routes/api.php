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
     * API Route group for alumni management; also includes the following sub-modules:
     *
     * - Alumni Undergraduate Job @TODO
     * - Alumni Graduate Job      @TODO
     * - Alumni Company Profile   @TODO
     * - Alumni Graduate Thesis   @TODO
     */
    Route::prefix('alumni')->group(function () {
        $sParentNamespace = 'Alumni_Management';
        Route::get('read', "{$sParentNamespace}\AlumniApiController@getAll");
        Route::post('create', "{$sParentNamespace}\AlumniApiController@create");
        Route::post('update', "{$sParentNamespace}\AlumniApiController@update");
        Route::post('delete', "{$sParentNamespace}\AlumniApiController@delete");

        /**
         * Sample route group for sub modules of alumni table
         * (This sample route group is to be deleted)
         * Create a group for each sub module
         * - Alumni Undergraduate Job
         * - Alumni Graduate Job
         * - Alumni Company Profile
         * - Alumni Graduate Thesis
         */
        Route::prefix('competency')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniCompetencyApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniCompetencyApiController@create");
            // (Add route for update)
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniCompetencyApiController@bulkDelete");
        });

    });

    /**
     * Set the API route group for form management, also includes the following sub-modules:
     *
     * - Form Question Group
     * - Form Question Type
     * - Form Questions
     * - Form Question Choices
     * - Form Answers
     */
    Route::prefix('form')->group(function () {

    });

    /**
     * Set the API route group for the following sub-modules in system admin:
     *
     * - Course Management
     * - Account Type Management
     * - Post Type Management
     * - Industry Management
     */
    $aModules = [
        'course'          => 'CourseApiController',
        'acc_type'        => 'AccountTypeApiController',
        'post_type'       => 'PostTypeApiController',
        'industry'        => 'IndustryApiController'
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
