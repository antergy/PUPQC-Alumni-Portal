<?php

namespace App\Http\Rules\API\Post_Management;

/**
 * Class LikeRules
 * @package App\Http\Rules\API\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class LikeRules
{
    /**
     * Rules for creating like record
     *
     * @var \string[][]
     */
    public $aLikeCreate = [
        'lk_acc_id'    => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'lk_post_id'   => [
            'required',
            'exists:t_posts,post_id'
        ]
    ];

    /**
     * Rules for updating like record
     *
     * @var \string[][]
     */
    public $aLikeUpdate = [
        'lk_id'    => [
            'required',
            'exists:t_likes,lk_id'
        ],
        'lk_status' => [
            'required',
            'numeric'
        ],
    ];
}
