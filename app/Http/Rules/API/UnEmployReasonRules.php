<?php

namespace App\Http\Rules\API;

/**
 * Class UnEmployReasonRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class UnEmployReasonRules
{
    /**
     * Rules for creating unemployment reason record
     *
     * @var \string[]
     */
    public $aUnEmployReasonCreate = [
        'ur_desc' => [
            'required',
            'max:225'
        ]
    ];
}
