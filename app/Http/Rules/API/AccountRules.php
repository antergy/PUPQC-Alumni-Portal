<?php

namespace App\Http\Rules\API;

/**
 * Class AccountRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 */
class AccountRules
{
    /**
     * Rules for creating account record
     *
     * @var \string[][]
     */
    public $aAccountCreate = [
        'acc_username' => [
            'required',
            'max:50'
        ],
        'acc_password' => [
            'required',
            'max:50'
        ],
        'acc_name' => [
            'required',
            'max:100'
        ],
        'acc_email' => [
            'required',
            'max:100'
        ],
        'acc_type' => [
            'required',
            'exists:r_account_types,at_id'
        ],
    ];

    /**
     * Rules for creating updating record
     *
     * @var \string[][]
     */
    public $aAccountUpdate = [
        'acc_username' => [
            'max:50'
        ],
        'acc_password' => [
            'max:50'
        ],
        'acc_name'     => [
            'max:100'
        ],
        'acc_email'    => [
            'max:100'
        ],
        'acc_type'     => [
            'integer',
            'exists:r_account_types,at_id'
        ],
        'acc_status'   => [
            'integer'
        ]
    ];
}
