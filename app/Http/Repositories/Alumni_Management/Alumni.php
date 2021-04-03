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
    public $sPrimaryKey = 'al_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username'     => 't_accounts',
        'course_desc'      => 'r_courses',
        'honor_desc'       => 'r_honors_received',
        'educ_attain_desc' => 'r_educational_attainment',
        'profex_desc'      => 'r_professional_exams',
        'fjtf_desc'        => 'r_first_job_timeframe',
        'fjd_desc'         => 'r_first_job_discover',
        'se_salary_desc'   => 'r_self_employed_salary',
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
        'al_honors_received',
        'al_educ_attainment',
        'al_educ_attainment_others',
        'al_prof_exam_passed',
        'al_prof_exam_passed_others',
        'al_employment_status',
        'al_first_job_desc',
        'al_first_job_discover',
        'al_first_job_timeframe',
        'al_work_place',
        'al_work_place_intl',
        'al_self_employ_salary',
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
        'al_mobile_num',
        'al_educ_attainment_others',
        'al_prof_exam_passed_others',
        'al_first_job_desc',
        'al_work_place_intl'
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

    /**
     * Join the honors received reference table
     * @param string $sType
     */
    public function joinHonorsReceivedTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_honors_received';
        $sForeignKey = 'r_honors_received.honor_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_honors_received', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the educational attainment reference table
     * @param string $sType
     */
    public function joinEducAttainTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_educ_attainment';
        $sForeignKey = 'r_educational_attainment.educ_attain_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_educational_attainment', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the professional exam reference table
     * @param string $sType
     */
    public function joinProfExamTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_prof_exam_passed';
        $sForeignKey = 'r_professional_exams.profex_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_professional_exams', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the first job timeframe  reference table
     * @param string $sType
     */
    public function joinFirstJobTimeFrameTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_first_job_timeframe';
        $sForeignKey = 'r_first_job_timeframe.fjtf_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_first_job_timeframe', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the first job discover reference table
     * @param string $sType
     */
    public function joinFirstJobDiscoverTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_first_job_discover';
        $sForeignKey = 'r_first_job_discover.fjd_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_first_job_discover', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the self employed salary reference table
     * @param string $sType
     */
    public function joinSelfEmploySalaryTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni.al_self_employ_salary';
        $sForeignKey = 'r_self_employed_salary.se_salary_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_self_employed_salary', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
