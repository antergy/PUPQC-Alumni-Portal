<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniImpactEducRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniImpactEducRules
{
    /**
     * Rules for creating alumni impact of education record
     *
     * @var \string[][]
     */
    public $aAlImpactEducCreate = [
        'aled_alumni_id'        => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'aled_impact_education' => [
            'required',
            'exists:r_impact_of_education,ioe_id'
        ],
        'aled_rating'           => [
            'required'
        ],
    ];
}
