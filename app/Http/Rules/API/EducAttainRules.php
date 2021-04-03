<?php

namespace App\Http\Rules\API;

/**
 * Class EducAttainRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class EducAttainRules
{
    /**
     * Rules for creating educational attainment record
     *
     * @var \string[][]
     */
    public $aEducAttainCreate = [
        'educ_attain_desc' => [
            'required',
            'max:225'
        ]
    ];
}
