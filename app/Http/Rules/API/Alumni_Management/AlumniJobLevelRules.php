<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniJobLevelRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniJobLevelRules
{
    /**
     * Rules for creating alumni job level classification record
     *
     * @var \string[][]
     */
    public $aAlJobLevelCreate = [
        'ajle_alumni_id'    => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'ajle_job_level_id' => [
            'required',
            'exists:r_job_level_classification,jlc_id'
        ],
        'ajle_occurence'    => [
            'numeric'
        ],
    ];

    /**
     * Rules for updating alumni job level classification record
     *
     * @var \string[][]
     */
    public $aAlJobLevelUpdate = [
        'ajle_alumni_id'    => [
            'exists:t_alumni,al_id'
        ],
        'ajle_job_level_id' => [
            'exists:r_job_level_classification,jlc_id'
        ],
        'ajle_occurence'    => [
            'numeric'
        ],
    ];
}
