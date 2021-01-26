<?php

namespace App\Http\Repositories\Post_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class LikeRepository
 * @package App\Http\Repositories\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class LikeRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_likes';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'lk_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username as Liked_by' => 't_accounts'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'lk_id',
        'lk_post_id',
        'lk_acc_id',
        'lk_status',
        't_likes.updated_at',
    ];

    /**
     * Inner join the post table
     * @param string $sType
     */
    public function joinPostTable($sType = 'inner')
    {
        $sReferenceKey = 't_likes.lk_post_id';
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
        $sReferenceKey = 't_likes.lk_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
