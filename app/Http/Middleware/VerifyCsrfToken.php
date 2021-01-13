<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * NOTE: All POST routes are temporarily excluded in the VerifyCsrfToken for testing purposes
     * If the post route you are currently testing is not included here, it may return a "page/request expire error"
     * This will be cleared once the UI and a proper middleware is established.
     */

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

        // Course Management routes (temp exclusion)
        'v1/course/create',
        'v1/course/update',
        'v1/course/delete',

        // Account type Management routes (temp exclusion)
        'v1/acc_type/create',
        'v1/acc_type/update',
        'v1/acc_type/delete',

        // Post type Management routes (temp exclusion)
        'v1/post_type/create',
        'v1/post_type/update',
        'v1/post_type/delete',

        // Educational Attainment Management routes (temp exclusion)
        'v1/educ_attain/create',
        'v1/educ_attain/update',
        'v1/educ_attain/delete',

        // Honors Received Management routes (temp exclusion)
        'v1/honors/create',
        'v1/honors/update',
        'v1/honors/delete',

        // Professional Education Management routes (temp exclusion)
        'v1/profex/create',
        'v1/profex/update',
        'v1/profex/delete',

        // First Job Timeframe Management routes (temp exclusion)
        'v1/fjtf/create',
        'v1/fjtf/update',
        'v1/fjtf/delete',

        // First Job Discover Management routes (temp exclusion)
        'v1/fjd/create',
        'v1/fjd/update',
        'v1/fjd/delete',

        // Job Level Management routes (temp exclusion)
        'v1/job_level/create',
        'v1/job_level/update',
        'v1/job_level/delete',

        // Self Employed Salary Management routes (temp exclusion)
        'v1/se_salary/create',
        'v1/se_salary/update',
        'v1/se_salary/delete',

        // Unemployement Reason Management routes (temp exclusion)
        'v1/unemploy_reason/create',
        'v1/unemploy_reason/update',
        'v1/unemploy_reason/delete',

        // Industry Management routes (temp exclusion)
        'v1/industry/create',
        'v1/industry/update',
        'v1/industry/delete',

        // Competency Management routes (temp exclusion)
        'v1/competency/create',
        'v1/competency/update',
        'v1/competency/delete',

        // Impact of Education Management routes (temp exclusion)
        'v1/ioe/create',
        'v1/ioe/update',
        'v1/ioe/delete',
    ];
}
