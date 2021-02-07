<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniUnemployedReasonRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniUnemployedReasonRules
{
    /**
     * Rules for creating unemployment reason record
     *
     * @var \string[][]
     */
    public $aAlUnemployReasonCreate = [
        'aur_alumni_id'       => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'aur_unemploy_reason' => [
            'required',
            'exists:r_unemployment_reason,ur_id'
        ],
        'aur_other_desc'      => [
            'string'
        ],
    ];

    /**
     * Rules for updating unemployment reason record
     *
     * @var \string[][]
     */
    public $aAlUnemployReasonUpdate = [
        'aur_alumni_id'       => [
            'exists:t_alumni,al_id'
        ],
        'aur_unemploy_reason' => [
            'exists:r_unemployment_reason,ur_id'
        ],
        'aur_other_desc'      => [
            'string'
        ],
    ];
}
