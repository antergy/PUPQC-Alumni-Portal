<?php

namespace App\Http\Rules\API;

/**
 * Class ProfExamRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class ProfExamRules
{
    /**
     * Rules for creating professional exams record
     *
     * @var \string[]
     */
    public $aProfExamCreate = [
        'profex_desc' => [
            'required',
            'max:225'
        ]
    ];
}
