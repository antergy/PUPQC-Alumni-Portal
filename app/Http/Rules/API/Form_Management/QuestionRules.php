<?php


namespace App\Http\Rules\API\Form_Management;

/**
 * Class QuestionRules
 * @package App\Http\Rules\API\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/29/2021
 * @version 1.0
 */
class QuestionRules
{
    /**
     * Rules for creating a question
     *
     * @var \string[][]
     */
    public $aQuestionCreate = [
        'fq_sequence_no'   => [
            'required'
        ],
        'fq_desc'          => [
            'required'
        ],
        'fq_fqg_id'        => [
            'required'
        ],
        'fq_fqt_id'        => [
            'required'
        ],
        'fq_active_status' => [
            'required'
        ],
    ];

    /**
     * Rules for updating a question
     *
     * @var \string[][]
     */
    public $aQuestionUpdate = [
        'fq_id'            => [
            'required',
            'exists:r_form_questions,fq_id'
        ],
        'fq_sequence_no'   => [
            'required'
        ],
        'fq_desc'          => [
            'required'
        ],
        'fq_fqg_id'        => [
            'required'
        ],
        'fq_fqt_id'        => [
            'required'
        ],
        'fq_active_status' => [
            'required'
        ],
    ];

    /**
     * Rules for create a question group
     *
     * @var \string[][]
     */
    public $aQuestionGroupCreate = [
        'fqg_sequence_no'   => [
            'required'
        ],
        'fqg_desc'          => [
            'required'
        ],
        'fqg_form_id'        => [
            'required'
        ],
    ];

    /**
     * Rules for updating a question group
     *
     * @var \string[][]
     */
    public $aQuestionGroupUpdate = [
        'fqg_id'            => [
            'required',
            'exists:r_form_question_group,fqg_id'
        ],
        'fqg_sequence_no'   => [
            'required'
        ],
        'fqg_desc'          => [
            'required'
        ],
        'fqg_form_id'        => [
            'required'
        ],
    ];

    /**
     * Rules for create a question type
     *
     * @var \string[][]
     */
    public $aQuestionTypeCreate = [
        'fqt_desc'   => [
            'required'
        ]
    ];

    /**
     * Rules for updating a question type
     *
     * @var \string[][]
     */
    public $aQuestionTypeUpdate = [
        'fqt_id'            => [
            'required',
            'exists:r_form_question_type,fqt_id'
        ],
        'fqt_desc'          => [
            'required'
        ],
    ];
}
