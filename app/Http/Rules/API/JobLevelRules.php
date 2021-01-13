<?php

namespace App\Http\Rules\API;

/**
 * Class JobLevelRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class JobLevelRules
{
    /**
     * Rules for creating job level record
     *
     * @var \string[]
     */
    public $aJobLevelCreate = [
        'jlc_desc' => [
            'required',
            'max:225'
        ]
    ];
}
