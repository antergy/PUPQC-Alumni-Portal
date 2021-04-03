<?php

namespace App\Http\Repositories\Post_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class PostRepository
 * @package App\Http\Repositories\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class PostRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_posts';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'p_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username' => 't_accounts',
        'pt_desc'      => 'r_post_types',
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'p_id',
        'p_title',
        'p_desc',
        'p_picture',
        'p_acc_id',
        'p_type_id',
        'p_course_id',
        't_posts.created_at',
        't_posts.updated_at',
    ];

    /**
     * Encrypted Keys
     * @var string[]
     */
    public $aEncryptedKeys = [
        'p_desc'
    ];

    /**
     * Inner join the account table
     * @param string $sType
     */
    public function joinAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_posts.p_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the post type table
     * @param string $sType
     */
    public function joinPostTypeTable($sType = 'inner')
    {
        $sReferenceKey = 't_posts.p_type_id';
        $sForeignKey = 'r_post_types.pt_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_post_types', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the course table
     * @param string $sType
     */
    public function joinCourseTable($sType = 'inner')
    {
        $sReferenceKey = 't_posts.p_course_id';
        $sForeignKey = 'r_courses.course_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_courses', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
