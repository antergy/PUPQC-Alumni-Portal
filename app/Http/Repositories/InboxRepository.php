<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class InboxRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/19/2021
 * @version 1.0
 */
class InboxRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_inboxes';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'in_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username as sender_username' => 't_accounts',
        'acc_name as sender_name '        => 't_accounts',
        'acc_email as sender_email'       => 't_accounts',
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'in_id',
        'in_subject',
        'in_message',
        'in_acc_id_from',
        'in_acc_id_to',
        't_inboxes.created_at'
    ];

    /**
     * Encrypted keys
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
      'in_message'
    ];

    /**
     * Inner join the account (sender) table
     * @param string $sType
     */
    public function joinAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_inboxes.in_acc_id_from';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
