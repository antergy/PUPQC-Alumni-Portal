<?php

namespace App\Http\Repositories\Post_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class CommentRepository
 * @package App\Http\Repositories\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class CommentRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_comments';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'cm_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username as commented_by' => 't_accounts'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'cm_id',
        'cm_desc',
        'cm_post_id',
        'cm_acc_id',
        't_comments.updated_at',
    ];

    /**
     * Encrypted keys
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'cm_desc'
    ];

    /**
     * Inner join the post table
     * @param string $sType
     */
    public function joinPostTable($sType = 'inner')
    {
        $sReferenceKey = 't_comments.cm_post_id';
        $sForeignKey = 't_posts.p_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_posts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the account table
     * @param string $sType
     */
    public function joinAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_comments.cm_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
