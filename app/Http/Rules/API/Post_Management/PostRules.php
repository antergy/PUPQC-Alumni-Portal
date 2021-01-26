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
        'p_title'     => [
            'required',
            'max:225'
        ],
        'p_desc'      => [
            'required'
        ],
        'p_picture'   => [
            'string',
            'max:225'
        ],
        'p_acc_id'    => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'p_type_id'   => [
            'required',
            'exists:r_post_types,pt_id'
        ],
        'p_course_id' => [
            'exists:r_courses,course_id'
        ],
    ];
}
