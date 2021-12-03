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
        'v1/post_type/switch',

        // Industry Management routes (temp exclusion)
        'v1/industry/create',
        'v1/industry/update',
        'v1/industry/delete',

        // Account Management routes (temp exclusion)
        'v1/account/create',
        'v1/account/update',
        'v1/account/delete',

        // Account Management admin route (temp exclusion)
        'admin/account/create',
        'admin/account/update',
        'admin/account/deactivate',

        // Visit Logs Management API routes (temp exclusion)
        'v1/visit_logs/create',

        // Visit Logs Management Admin routes (temp exclusion)
        'admin/visit_logs/create',

        // Inbox Management API routes (temp exclusion)
        'v1/message/create',
        'v1/message/delete',

        // Inbox Management Admin routes (temp exclusion)
        'admin/message/create',
        'admin/message/delete',

        // Post Management API routes (temp exclusion)
        'v1/posts/create',
        'v1/posts/update',
        'v1/posts/delete',
        // Likes Management API routes (temp exclusion)
        'v1/posts/likes/create',
        'v1/posts/likes/update',
        'v1/posts/likes/delete',
        'v1/posts/likes/deleteByPost',
        // Comments Management API routes (temp exclusion)
        'v1/posts/comments/create',
        'v1/posts/comments/update',
        'v1/posts/comments/delete',
        'v1/posts/comments/deleteByPost',

        // Post Management Admin routes (temp exclusion)
        'admin/posts/create',
        'admin/posts/update',
        'admin/posts/delete',
        // Likes Management Admin routes (temp exclusion)
        'admin/posts/likes/manage',
        'admin/posts/likes/delete',
        // Comments Management Admin routes (temp exclusion)
        'admin/posts/comments/create',
        'admin/posts/comments/update',
        'admin/posts/comments/delete',

        // Alumni Management API routes (temp exclusion)
        'v1/alumni/create',
        'v1/alumni/update',
        'v1/alumni/delete',

        // Alumni Shared Contacts Management API routes (temp exclusion)
        'v1/alumni/shared_contacts/create',
        'v1/alumni/shared_contacts/update',
        'v1/alumni/shared_contacts/delete',
        'v1/alumni/shared_contacts/deleteByAlumni',

        // Alumni impact of education Management API routes (temp exclusion)
        'v1/alumni/ioe/create',
        'v1/alumni/ioe/deleteByAlumni',

        // Alumni Work Exp Management API routes (temp exclusion)
        'v1/alumni/work_exp/create',
        'v1/alumni/work_exp/update',
        'v1/alumni/work_exp/delete',
        'v1/alumni/work_exp/deleteByAlumni',

        // Alumni Unemployed Reason Management API routes (temp exclusion)
        'v1/alumni/unemploy_reason/create',
        'v1/alumni/unemploy_reason/update',
        'v1/alumni/unemploy_reason/delete',
        'v1/alumni/unemploy_reason/deleteByAlumni',

        // Alumni Job Level Classification Management API routes (temp exclusion)
        'v1/alumni/ajle/create',
        'v1/alumni/ajle/update',
        'v1/alumni/ajle/delete',
        'v1/alumni/ajle/deleteByAlumni',

        // Alumni Competencies Management API routes (temp exclusion)
        'v1/alumni/competency/create',
        'v1/alumni/competency/deleteByAlumni',

        // New routes from system mgt
        'v1/branch/create',
        'v1/branch/update',
        'v1/branch/switch',
    ];
}
