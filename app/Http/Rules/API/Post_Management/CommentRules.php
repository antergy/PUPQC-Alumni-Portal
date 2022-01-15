<?php

namespace App\Http\Rules\API\Post_Management;

/**
 * Class CommentRules
 * @package App\Http\Rules\API\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class CommentRules
{
    /**
     * Rules for creating comment record
     *
     * @var \string[][]
     */
    public $aCommentCreate = [
        'cm_desc'    => [
            'required'
        ],
        'cm_acc_id'  => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'cm_post_id' => [
            'required',
            'exists:t_posts,post_id'
        ]
    ];

    /**
     * Rules for updating comment record
     *
     * @var \string[][]
     */
    public $aCommentUpdate = [
        'cm_id'   => [
            'required',
            'exists:t_comments,cm_id'
        ],
        'cm_desc' => [
            'required'
        ],
    ];
}
