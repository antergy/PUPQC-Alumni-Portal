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
     * - Alumni Job Level Classification
     * - Alumni Competencies
     * - Alumni Work Experience
     * - Alumni Impact of Education
     * - Alumni Unemployment Reason
     * - Alumni Shared Contacts
     */
    Route::prefix('alumni')->group(function () {
        $sParentNamespace = 'Alumni_Management';
        Route::get('read', "{$sParentNamespace}\AlumniApiController@getAll");
        Route::post('create', "{$sParentNamespace}\AlumniApiController@create");
        Route::post('update', "{$sParentNamespace}\AlumniApiController@update");
        Route::post('delete', "{$sParentNamespace}\AlumniApiController@delete");

        Route::prefix('competency')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniCompetencyApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniCompetencyApiController@create");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniCompetencyApiController@bulkDelete");
        });

        Route::prefix('ajle')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniJobLevelApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniJobLevelApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniJobLevelApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniJobLevelApiController@delete");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniJobLevelApiController@bulkDelete");
        });

        Route::prefix('unemploy_reason')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniUnemployedReasonApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniUnemployedReasonApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniUnemployedReasonApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniUnemployedReasonApiController@delete");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniUnemployedReasonApiController@bulkDelete");
        });

        Route::prefix('work_exp')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniWorkExpApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniWorkExpApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniWorkExpApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniWorkExpApiController@delete");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniWorkExpApiController@bulkDelete");
        });

        Route::prefix('ioe')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniImpactEducationApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniImpactEducationApiController@create");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniImpactEducationApiController@bulkDelete");
        });

        Route::prefix('shared_contacts')->group(function () use ($sParentNamespace) {
            Route::get('read', "{$sParentNamespace}\AlumniSharedContactApiController@getAll");
            Route::post('create', "{$sParentNamespace}\AlumniSharedContactApiController@create");
            Route::post('update', "{$sParentNamespace}\AlumniSharedContactApiController@update");
            Route::post('delete', "{$sParentNamespace}\AlumniSharedContactApiController@delete");
            Route::post('deleteByAlumni', "{$sParentNamespace}\AlumniSharedContactApiController@bulkDelete");
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
