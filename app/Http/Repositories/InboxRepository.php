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
        'sender_acc_username as sender_username' => 'sender_view',
        'sender_acc_name as sender_name' => 'sender_view',
        'sender_acc_email as sender_email' => 'sender_view',
        'receiver_acc_username as receiver_username' => 'receiver_view',
        'receiver_acc_name as receiver_name' => 'receiver_view',
        'receiver_acc_email as receiver_email' => 'receiver_view',
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
        'in_is_reply',
        'in_inbox_id',
        'in_is_read',
        't_inboxes.created_at',
        't_inboxes.updated_at',
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
    public function joinSenderAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_inboxes.in_acc_id_from';
        $sForeignKey = 'sender_view.sender_acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('sender_view', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the account (receiver) table
     * @param string $sType
     */
    public function joinReceiverAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_inboxes.in_acc_id_to';
        $sForeignKey = 'receiver_view.receiver_acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('receiver_view', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
