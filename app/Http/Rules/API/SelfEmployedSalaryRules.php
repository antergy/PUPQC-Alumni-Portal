<?php

namespace App\Http\Rules\API;

/**
 * Class SelfEmployedSalaryRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class SelfEmployedSalaryRules
{
    /**
     * Rules for creating self employed salary record
     *
     * @var \string[]
     */
    public $aSelfEmploySalaryCreate = [
        'se_salary_desc' => [
            'required',
            'max:225'
        ]
    ];
}
