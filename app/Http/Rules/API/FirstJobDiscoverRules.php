<?php

namespace App\Http\Rules\API;

/**
 * Class FirstJobDiscoverRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class FirstJobDiscoverRules
{
    /**
     * Rules for creating first job discover record
     *
     * @var \string[]
     */
    public $aFirstJobDiscoverCreate = [
        'fjd_desc' => [
            'required',
            'max:225'
        ]
    ];
}
