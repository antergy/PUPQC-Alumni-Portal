<?php

namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class QuestionRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/10/2021
 * @version 1.0
 */
class QuestionRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_questions';

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
    public $sPrimaryKey = 'fq_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fq_id',
        'fq_sequence_no',
        'fq_desc',
        'fq_fqg_id',
        'fq_fqt_id',
        'fq_secondary_fqt_id',
        'fq_active_status',
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
     * Inner join the question group table
     *
     * @param string $sType
     */
    public function joinFormQuestionGroupTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_questions.fq_fqg_id';
        $sForeignKey = 'r_form_question_group.fqg_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form_question_group', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the question type table
     *
     * @param string $sType
     */
    public function joinFormQuestionTypeTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_questions.fq_fqt_id';
        $sForeignKey = 'r_form_question_type.fqt_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form_question_type', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
