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
class FormAnswerGroupRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_answer_group';

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
    public $sPrimaryKey = 'fag_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fag_id',
        'fag_form_id',
        'fag_reference_no',
        'fag_name',
        'fag_email',
        'fag_acc_id',
        'fag_status',
        'fag_remarks',
        'form_desc',
        'acc_username',
        'acc_email',
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
    public function joinFormTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_answer_group.fag_form_id';
        $sForeignKey = 'r_form.form_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_form', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the accounts table
     *
     * @param string $sType
     */
    public function joinAccountTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form_answer_group.fag_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
