<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class Alumni
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class Alumni extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'alumni_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username'     => 't_accounts',
        'course_desc'      => 'r_courses'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'al_id',
        'al_acc_id',
        'al_firstname',
        'al_middlename',
        'al_lastname',
        'al_birthdate',
        'al_address',
        'al_email',
        'al_tel_num',
        'al_mobile_num',
        'al_student_num',
        'al_civil_status',
        'al_course_id',
        'al_year_graduated',
        't_alumni.updated_at',
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'al_address',
        'al_email',
        'al_tel_num',
        'al_mobile_num'
    ];

    /**
     * Inner join the accounts table
     * @param string $sType
     */
    public function joinAccountsTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the course reference table
     * @param string $sType
     */
    public function joinCourseTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_course_id';
        $sForeignKey = 'r_courses.course_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_courses', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

}
