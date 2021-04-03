<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniCompetencyRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniCompetencyRules
{
    /**
     * Rules for creating alumni competency record
     *
     * @var \string[][]
     */
    public $aAlCompetencyCreate = [
        'alcom_alumni_id'      => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'alcom_competency'    => [
            'required',
            'exists:r_competencies,competency_id'
        ],
        'alcom_acquire_level'  => [
            'required',
            'numeric'
        ],
        'alcom_relevant_level' => [
            'required',
            'numeric'
        ],
    ];
}
