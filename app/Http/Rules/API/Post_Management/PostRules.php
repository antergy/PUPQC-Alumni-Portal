<?php

namespace App\Http\Rules\API\Post_Management;

/**
 * Class PostRules
 * @package App\Http\Rules\API\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class PostRules
{
    /**
     * Rules for creating post record
     *
     * @var \string[][]
     */
    public $aPostCreate = [
        'post_desc'      => [
            'required'
        ],
        'post_acc_id'    => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'post_pt_id'     => [
            'required',
            'exists:r_post_types,pt_id'
        ],
        'post_degree_id' => [
            'exists:r_degree,degree_id'
        ],
        'post_course_id' => [
            'exists:r_courses,course_id'
        ],
    ];
}
