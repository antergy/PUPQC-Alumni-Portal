<?php

namespace App\Http\Rules\API;

/**
 * Class FirstJobTimeFrameRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class FirstJobTimeFrameRules
{
    /**
     * Rules for creating first job timeframe record
     *
     * @var \string[]
     */
    public $aFirstJobTimeFrameCreate = [
        'fjtf_desc' => [
            'required',
            'max:225'
        ]
    ];
}
