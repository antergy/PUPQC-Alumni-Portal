<?php

namespace App\Http\Rules\API;

/**
 * Class ImpactEducationRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class ImpactEducationRules
{
    /**
     * Rules for creating impact of education record
     *
     * @var \string[]
     */
    public $aImpactEducationCreate = [
        'ioe_desc' => [
            'required'
        ]
    ];
}
