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
     * Route group for account management
     */
    Route::prefix('account')->group(function () {
        Route::get('read', 'AccountAdminController@manageRequest');
        Route::post('create', 'AccountAdminController@manageRequest');
        Route::post('update', 'AccountAdminController@manageRequest');
        Route::post('deactivate', 'AccountAdminController@manageRequest');
    });

    /**
     * Route group for account management
     */
    Route::prefix('visit_logs')->group(function () {
        Route::get('read', 'VisitLogAdminController@retrieveLogs');
    });

    /**
     * Route group for inbox management
     */
    Route::prefix('message')->group(function () {
        Route::get('read', 'InboxAdminController@manageRequest');
        Route::get('readDetails', 'PostAdminController@getDetailedForm');
        Route::post('create', 'InboxAdminController@manageRequest');
        Route::post('delete', 'InboxAdminController@manageRequest');
    });

    /**
     * Route group for form management
     */
    Route::prefix('form')->group(function() {
        Route::get('read', "FormAdminController@readForms");
        Route::get('read/only', "FormAdminController@readFormOnly");
        Route::post('create', "FormAdminController@createForm");
        Route::post('update', "FormAdminController@updateForm");
        Route::post('delete', "FormAdminController@deleteForm");
        Route::post('switch', "FormAdminController@switchUpdateForm");

        Route::prefix('questions')->group(function() {
            Route::get('read', "QuestionAdminController@readQuestions");
            Route::post('create', "QuestionAdminController@createQuestion");
            Route::post('update', "QuestionAdminController@updateQuestion");
            Route::post('delete', "QuestionAdminController@deleteQuestion");
            Route::post('switch', "QuestionAdminController@switchUpdateQuestion");


            Route::prefix('choices')->group(function() {
                Route::get('read', "ChoicesAdminController@readChoices");
                Route::post('create', "ChoicesAdminController@createChoice");
                Route::post('update', "ChoicesAdminController@updateChoice");
                Route::post('delete', "ChoicesAdminController@deleteChoice");
                Route::post('update_by_question', "ChoicesAdminController@updateChoicesByQuestion");
            });

            Route::prefix('answers')->group(function() {
                Route::get('read', "QuestionAnswerAdminController@readAnswers");
                Route::post('create', "QuestionAnswerAdminController@createAnswer");
                Route::post('update', "QuestionAnswerAdminController@updateAnswer");
                Route::post('delete', "QuestionAnswerAdminController@deleteAnswer");
            });

            Route::prefix('group')->group(function() {
                Route::get('read', "QuestionGroupAdminController@readQuestionGroups");
                Route::post('create', "QuestionGroupAdminController@createQuestionGroup");
                Route::post('update', "QuestionGroupAdminController@updateQuestionGroup");
                Route::post('delete', "QuestionGroupAdminController@deleteQuestionGroup");
                Route::post('switch', "QuestionGroupAdminController@switchUpdateQuestionGroup");
            });

            Route::prefix('type')->group(function() {
                Route::get('read', "QuestionTypeAdminController@readQuestionTypes");
                Route::post('create', "QuestionTypeAdminController@createQuestionType");
                Route::post('update', "QuestionTypeAdminController@updateQuestionType");
                Route::post('delete', "QuestionTypeAdminController@deleteQuestionType");
                Route::post('switch', "QuestionTypeAdminController@switchUpdateQuestionType");
            });
        });
    });

    /**
     * Route group for post management
     */
    Route::prefix('posts')->group(function () {
        Route::get('read', 'PostAdminController@readPosts');
        Route::get('readDetails', 'PostAdminController@getDetailedPost');
        Route::post('create', 'PostAdminController@createPost');
        Route::post('update', 'PostAdminController@updatePost');
        Route::post('delete', 'PostAdminController@deletePost');

        /** Route group for post's likes management */
        Route::prefix('likes')->group(function () {
            Route::get('read', 'PostAdminController@getLikes');
            Route::post('manage', 'PostAdminController@manageLikes');
        });

        /** Route group for post's comment management */
        Route::prefix('comments')->group(function () {
            Route::get('read', 'PostAdminController@getComments');
            Route::post('create', 'PostAdminController@manageComments');
            Route::post('update', 'PostAdminController@manageComments');
            Route::post('delete', 'PostAdminController@manageComments');
        });
    });

    /**
     * Route group for alumni management
     */
    Route::prefix('alumni')->group(function () {
        Route::get('read', 'AlumniAdminController@getAllAlumni');
        Route::get('readDetails', 'AlumniAdminController@getAlumniDetails');
        Route::get('readReflectDetails', 'AlumniAdminController@getAlumniReflectionDetails');
//        Route::post('create', 'PostAdminController@createPost');
//        Route::post('update', 'PostAdminController@updatePost');
//        Route::post('delete', 'PostAdminController@deletePost');
    });

    /**
     * Set the Admin route group for the following sub-modules
     * in system admin under system route group:
     *
     * - Branch Management
     * - Course Management
     * - Degree Management
     * - Account Type Management
     * - Post Type Management
     * - Industry Management
     */
    Route::prefix('system')->group(function () {
        $aModules = [
            'branch',
            'course',
            'degree',
            'acc_type',
            'post_type',
            'industry'
        ];
        foreach ($aModules as $sModule) {
            Route::prefix($sModule)->group(function () {
                Route::get('read', 'SystemAdminController@manageRequest');
                Route::post('create', 'SystemAdminController@manageRequest');
                Route::post('update', 'SystemAdminController@manageRequest');
                Route::post('delete', 'SystemAdminController@manageRequest');
                Route::post('switch', 'SystemAdminController@manageRequest');
            });
        }
    });
});
