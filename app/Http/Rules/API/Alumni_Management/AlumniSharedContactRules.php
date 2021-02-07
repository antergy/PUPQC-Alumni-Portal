<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniSharedContactRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniSharedContactRules
{
    /**
     * Rules for creating alumni shared contact record
     *
     * @var \string[][]
     */
    public $aAlSharedContactCreate = [
        'asc_shared_by'   => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'asc_name'        => [
            'required',
            'max:100'
        ],
        'asc_email'       => [
            'required',
            'max:100'
        ],
        'asc_contact_num' => [
            'required',
            'max:15'
        ],
    ];

    /**
     * Rules for updating alumni shared contact record
     *
     * @var \string[][]
     */
    public $aAlSharedContactUpdate = [
        'asc_shared_by'   => [
            'exists:t_alumni,al_id'
        ],
        'asc_name'        => [
            'max:100'
        ],
        'asc_email'       => [
            'max:100'
        ],
        'asc_contact_num' => [
            'max:15'
        ],
    ];
}
