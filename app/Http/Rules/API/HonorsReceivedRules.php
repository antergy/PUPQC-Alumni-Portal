<?php

namespace App\Http\Rules\API;

/**
 * Class HonorsReceivedRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class HonorsReceivedRules
{
    /**
     * Rules for creating honors received record
     *
     * @var \string[][]
     */
    public $aHonorsReceivedCreate = [
        'honor_desc' => [
            'required',
            'max:225'
        ]
    ];
}
