<?php

namespace App\Http\Rules\API;

/**
 * Class CompetencyRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class CompetencyRules
{
    /**
     * Rules for creating competency record
     *
     * @var \string[]
     */
    public $aCompetencyCreate = [
        'competency_desc' => [
            'required'
        ]
    ];
}
