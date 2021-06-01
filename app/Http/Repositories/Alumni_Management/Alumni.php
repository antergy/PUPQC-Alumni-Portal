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
        'alumni_id',
        'alumni_acc_id',
        'alumni_firstname',
        'alumni_middlename',
        'alumni_lastname',
        'alumni_birthdate',
        'alumni_gender',
        'alumni_address',
        'alumni_email',
        'alumni_tel_num',
        'alumni_mobile_num',
        'alumni_student_num',
        'alumni_civil_status',
        'alumni_course_id',
        'alumni_year_graduated',
        'alumni_year_grad_complete_program',
        'alumni_age_graduate_enrolled',
        'alumni_employ_status',
        'alumni_unemploy_status',
        't_alumni.updated_at',
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'alumni_address',
        'alumni_email',
        'alumni_tel_num',
        'alumni_mobile_num'
    ];

    /**
     * Inner join the accounts table
     * @param string $sType
     */
    public function joinAccountsTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.alumni_acc_id';
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
        $sReferenceKey = 't_alumni.alumni_course_id';
        $sForeignKey = 'r_courses.course_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_courses', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

}
