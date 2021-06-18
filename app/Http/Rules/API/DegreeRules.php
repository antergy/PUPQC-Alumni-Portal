<?php

namespace App\Http\Rules\API;

/**
 * Class CourseRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/06/2021
 * @version 1.0
 */
class DegreeRules
{
    /**
     * Rules for creating course record
     *
     * @var \string[][]
     */
    public $aDegreeCreate = [
        'degree_desc' => [
            'required',
            'max:100'
        ]
    ];
}
