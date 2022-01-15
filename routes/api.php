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
        Route::post('change_status', "InboxesApiController@changeReadStatus");
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
    Route::prefix('form')->group(function() {
        $sParentNamespace = 'Form_Management';

        Route::get('read', "{$sParentNamespace}\FormApiController@getAll");
        Route::post('create', "{$sParentNamespace}\FormApiController@create");
        Route::post('update', "{$sParentNamespace}\FormApiController@update");
        Route::post('delete', "{$sParentNamespace}\FormApiController@delete");
        Route::post('switch', "{$sParentNamespace}\FormApiController@switchUpdate");

        Route::prefix('questions')->group(function() use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\QuestionApiController@getAll");
            Route::post('create', "{$sParentNamespace}\QuestionApiController@create");
            Route::post('update', "{$sParentNamespace}\QuestionApiController@update");
            Route::post('delete', "{$sParentNamespace}\QuestionApiController@delete");
            Route::post('switch', "{$sParentNamespace}\QuestionApiController@switchUpdate");

            Route::prefix('choices')->group(function() use ($sParentNamespace) {
                Route::get('read', "{$sParentNamespace}\ChoicesApiController@getAll");
                Route::post('create', "{$sParentNamespace}\ChoicesApiController@create");
                Route::post('update', "{$sParentNamespace}\ChoicesApiController@update");
                Route::post('delete', "{$sParentNamespace}\ChoicesApiController@delete");
                Route::post('delete_by_question', "{$sParentNamespace}\ChoicesApiController@deleteByQuestion");
            });

            Route::prefix('answers')->group(function() use ($sParentNamespace) {
                Route::get('read', "{$sParentNamespace}\FormAnswerApiController@getAll");
                Route::post('create', "{$sParentNamespace}\FormAnswerApiController@create");
                Route::post('create/multiple', "{$sParentNamespace}\FormAnswerApiController@createMultiple");
                Route::post('update', "{$sParentNamespace}\FormAnswerApiController@update");
                Route::post('delete', "{$sParentNamespace}\FormAnswerApiController@delete");
            });

            Route::prefix('group')->group(function() use ($sParentNamespace) {
                Route::get('read', "{$sParentNamespace}\QuestionGroupApiController@getAll");
                Route::post('create', "{$sParentNamespace}\QuestionGroupApiController@create");
                Route::post('update', "{$sParentNamespace}\QuestionGroupApiController@update");
                Route::post('delete', "{$sParentNamespace}\QuestionGroupApiController@delete");
                Route::post('switch', "{$sParentNamespace}\QuestionGroupApiController@switchUpdate");
            });

            Route::prefix('type')->group(function() use ($sParentNamespace) {
                Route::get('read', "{$sParentNamespace}\QuestionTypeApiController@getAll");
                Route::post('create', "{$sParentNamespace}\QuestionTypeApiController@create");
                Route::post('update', "{$sParentNamespace}\QuestionTypeApiController@update");
                Route::post('delete', "{$sParentNamespace}\QuestionTypeApiController@delete");
                Route::post('switch', "{$sParentNamespace}\QuestionTypeApiController@switchUpdate");
            });
        });
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
            Route::get('count', "{$sParentNamespace}\CommentApiController@getCount");
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

        Route::prefix('company_profile')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniCompanyProfileApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniCompanyProfileApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniCompanyProfileApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniCompanyProfileApiController@delete");
        });

        Route::prefix('graduate_job')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniGraduateJobApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniGraduateJobApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniGraduateJobApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniGraduateJobApiController@delete");
        });

        Route::prefix('graduate_thesis')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniGraduateThesisApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniGraduateThesisApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniGraduateThesisApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniGraduateThesisApiController@delete");
        });

        Route::prefix('undergraduate_job')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniUndergraduateJobApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniUndergraduateJobApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniUndergraduateJobApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniUndergraduateJobApiController@delete");
        });

    });

    /**
     * Set the API route group for the following sub-modules in system admin:
     *
     * - Course Management
     * - Account Type Management
     * - Post Type Management
     * - Industry Management
     * - Branch Management
     */
    $aModules = [
        'course'          => 'CourseApiController',
        'acc_type'        => 'AccountTypeApiController',
        'post_type'       => 'PostTypeApiController',
        'industry'        => 'IndustryApiController',
        'degree'          => 'DegreeApiController',
        'branch'          => 'BranchApiController'
    ];
    foreach ($aModules as $sModuleGroupName => $sModuleController) {
        Route::prefix($sModuleGroupName)->group(function () use($sModuleController) {
            Route::get('read', "{$sModuleController}@getAll");
            Route::post('create', "{$sModuleController}@create");
            Route::post('update', "{$sModuleController}@update");
            Route::post('delete', "{$sModuleController}@delete");
            Route::post('switch', "{$sModuleController}@switchUpdate");
        });
    }
});
