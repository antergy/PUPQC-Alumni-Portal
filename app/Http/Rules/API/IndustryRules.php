<?php

namespace App\Http\Rules\API;

/**
 * Class IndustryRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class IndustryRules
{
    /**
     * Rules for creating industry record
     *
     * @var \string[]
     */
    public $aIndustryCreate = [
        'industry_desc' => [
            'required',
            'max:225'
        ]
    ];
}
