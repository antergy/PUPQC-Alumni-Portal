<?php

namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class QuestionGroupRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/10/2021
 * @version 1.0
 */
class QuestionGroupRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_question_group';

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
    public $sPrimaryKey = 'fqg_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fqg_id',
        'fqg_sequence_no',
        'fqg_desc',
        'fqg_form_id',
        'status',
        'form_desc'
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
    public function joinFormTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_question_group.fqg_form_id';
        $sForeignKey = 'r_form.form_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
