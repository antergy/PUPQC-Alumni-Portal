<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class AccountRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 */
class AccountRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_accounts';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'at_desc'     => 'r_account_types'
    ];

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'acc_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'acc_id',
        'acc_username',
        'acc_name',
        'acc_email',
        'acc_picture',
        'acc_at_id',
        'acc_google_account',
        'acc_ans_tracer_form',
        'acc_status'
    ];

    /**
     * Separate field for password retrieval
     * @var string
     */
    public $sPasswordField = 'acc_password';

    /**
     * Fields allowed to be filtered by "LIKE"
     * @var string[]
     */
    public $aFieldsLikeAllowed = [
      'acc_username',
      'acc_email'
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'acc_password',
    ];

    /**
     * Inner join the account type table
     * @param string $sType
     */
    public function joinAccountTypesTable($sType = 'inner')
    {
        $sReferenceKey = 't_accounts.acc_at_id';
        $sForeignKey = 'r_account_types.at_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_account_types', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
