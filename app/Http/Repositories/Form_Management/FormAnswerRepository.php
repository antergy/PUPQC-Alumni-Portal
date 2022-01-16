<?php

namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class FormAnswerRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/01/2021
 * @version 1.0
 */
class FormAnswerRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_answers';

    /**
     * Foreign table columns to displayed in the result
     *
     * @var string[]
     */
    public $aForeignColumns = [
        //
    ];

    /**
     * Primary key of the table
     *
     * @var string
     */
    public $sPrimaryKey = 'fa_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fa_id',
        'fa_answer',
        'fa_fq_id',
        'fa_is_secondary_answer',
        'fa_fag_id',
        'fag_form_id',
    ];


    /**
     * Fields allowed to be filtered by "LIKE"
     * @var string[]
     */
    public $aFieldsLikeAllowed = [
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        //
    ];

    /**
     * Inner join the form questions table
     *
     * @param string $sType
     */
    public function joinFormQuestionTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_answers.fa_fq_id';
        $sForeignKey = 'r_form_questions.fq_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form_questions', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the accounts table
     *
     * @param string $sType
     */
    public function joinFormAnswerGroupTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_answers.fa_fag_id';
        $sForeignKey = 'r_form_answer_group.fag_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form_answer_group', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
