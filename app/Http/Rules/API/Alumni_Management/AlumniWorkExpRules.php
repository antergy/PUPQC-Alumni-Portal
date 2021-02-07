<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniWorkExpRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniWorkExpRules
{
    /**
     * Rules for creating work experience record
     *
     * @var \string[][]
     */
    public $aAlWorkExpCreate = [
        'awe_alumni_id'              => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'awe_industry_nature'        => [
            'required',
            'exists:r_industry,industry_id'
        ],
        'awe_industry_nature_others' => [
            'string'
        ],
        'awe_company_name'           => [
            'required',
            'string'
        ],
        'awe_company_address'        => [
            'required',
            'string'
        ],
        'awe_company_nature'         => [
            'required',
            'numeric'
        ],
        'awe_company_nature_others'  => [
            'string'
        ],
    ];

    /**
     * Rules for updating work experience record
     *
     * @var \string[][]
     */
    public $aAlWorkExpUpdate = [
        'awe_id'              => [
            'required',
            'exists:t_alumni_work_experience,awe_id'
        ],
        'awe_alumni_id'              => [
            'exists:t_alumni,al_id'
        ],
        'awe_industry_nature'        => [
            'exists:r_industry,industry_id'
        ],
        'awe_industry_nature_others' => [
            'string'
        ],
        'awe_company_name'           => [
            'string'
        ],
        'awe_company_address'        => [
            'string'
        ],
        'awe_company_nature'         => [
            'numeric'
        ],
        'awe_company_nature_others'  => [
            'string'
        ],
    ];
}
