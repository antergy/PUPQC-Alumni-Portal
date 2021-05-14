<?php

namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class ChoicesRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/10/2021
 * @version 1.0
 */
class ChoicesRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_question_choices';

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
    public $sPrimaryKey = 'fqc_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fqc_id',
        'fqc_desc',
        'fqc_fq_id',
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
    public function joinFormQuestionsTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_question_choices.fqc_fq_id';
        $sForeignKey = 'r_form_questions.fq_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form_questions', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
