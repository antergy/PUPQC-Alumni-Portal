<?php

namespace App\Http\Rules\API;

/**
 * Class BranchRules
 * @package App\Http\Rules\API
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class BranchRules
{
    /**
     * Rules for creating a branch record
     *
     * @var \string[][]
     */
    public $aBranchCreate = [
        'branch_name' => [
            'required',
            'max:225'
        ],
        'branch_address' => [
            'required',
            'max:20'
        ],
    ];

    /**
     * Rules for updating a branch record
     *
     * @var \string[][]
     */
    public $aBranchUpdate = [
        'branch_name' => [
            'required',
            'max:225'
        ],
        'branch_address' => [
            'required',
            'max:20'
        ],
    ];
}
