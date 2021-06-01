<?php


namespace App\Http\Rules\API\Form_Management;

/**
 * Class FormRules
 * @package App\Http\Rules\API\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class FormRules
{
    /**
     * Rules for creating a form
     *
     * @var \string[][]
     */
    public $aFormCreate = [
        'form_desc'          => [
            'required',
            'string'
        ],
        'form_degree_id'     => [
            'required'
        ],
        'form_course_id'     => [
            'required'
        ],
        'form_active_status' => [
            'required'
        ],
    ];

    /**
     * Rules for updating a form
     *
     * @var \string[][]
     */
    public $aFormUpdate = [
        'form_id'          => [
            'required',
            'exists:r_form,form_id'
        ],
        'form_desc'          => [
            'required',
            'string'
        ],
        'form_degree_id'     => [
            'required'
        ],
        'form_course_id'     => [
            'required'
        ],
        'form_active_status' => [
            'required'
        ],
    ];

    /**
     * Rules for creating a form answer
     *
     * @var \string[][]
     */
    public $aFormAnswerCreate = [
        'fa_answer'          => [
            'required'
        ],
        'fa_fq_id'     => [
            'required'
        ],
        'fa_acc_id'     => [
            'required'
        ],
    ];

    /**
     * Rules for updating a form answer
     *
     * @var \string[][]
     */
    public $aFormAnswerUpdate = [
        'fa_id'          => [
            'required',
            'exists:r_form_answers,fa_id'
        ],
        'fa_answer'          => [
            'required'
        ],
        'fa_fq_id'     => [
            'required'
        ],
        'fa_acc_id'     => [
            'required'
        ],
    ];
}
