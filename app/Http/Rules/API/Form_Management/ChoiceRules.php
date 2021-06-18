<?php


namespace App\Http\Rules\API\Form_Management;

/**
 * Class ChoiceRules
 * @package App\Http\Rules\API\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class ChoiceRules
{
    /**
     * Rules for creating a choice
     *
     * @var \string[][]
     */
    public $aChoiceCreate = [
        'fqc_desc'          => [
            'required'
        ],
        'fqc_fq_id'        => [
            'required'
        ],
    ];

    /**
     * Rules for updating a choice
     *
     * @var \string[][]
     */
    public $aChoiceUpdate = [
        'fqc_id'            => [
            'required',
            'exists:r_form_question_choices,fqc_id'
        ],
        'fqc_desc'          => [
            'required'
        ],
        'fqc_fq_id'        => [
            'required'
        ],
    ];
}
