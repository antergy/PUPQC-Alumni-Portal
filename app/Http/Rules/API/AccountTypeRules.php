<?php

namespace App\Http\Rules\API;

/**
 * Class AccountTypeRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class AccountTypeRules
{
    /**
     * Rules for creating account type record
     *
     * @var \string[][]
     */
    public $aAccountTypeCreate = [
        'at_desc' => [
            'required',
            'max:50'
        ]
    ];
}
