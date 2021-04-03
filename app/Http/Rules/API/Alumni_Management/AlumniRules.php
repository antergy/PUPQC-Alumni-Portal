<?php

namespace App\Http\Rules\API\Alumni_Management;

/**
 * Class AlumniRules
 * @package App\Http\Rules\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniRules
{
    /**
     * Rules for creating alumni record
     *
     * @var \string[][]
     */
    public $aAlumniCreate = [
        'al_acc_id'                  => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'al_firstname'               => [
            'required',
            'string'
        ],
        'al_middlename'              => [
            'string'
        ],
        'al_lastname'                => [
            'required',
            'string'
        ],
        'al_birthdate'               => [
            'required',
            'string'
        ],
        'al_address'                 => [
            'required',
            'string'
        ],
        'al_email'                   => [
            'required',
            'string'
        ],
        'al_tel_num'                 => [
            'string'
        ],
        'al_mobile_num'              => [
            'required',
            'string'
        ],
        'al_student_num'             => [
            'string'
        ],
        'al_civil_status'            => [
            'required',
            'numeric'
        ],
        'al_course_id'               => [
            'required',
            'exists:r_courses,course_id'
        ],
        'al_year_graduated'          => [
            'required',
            'numeric'
        ],
        'al_honors_received'         => [
            'required',
            'exists:r_honors_received,honor_id'
        ],
        'al_educ_attainment'         => [
            'required',
            'exists:r_educational_attainment,educ_attain_id'
        ],
        'al_educ_attainment_others'  => [
            'string'
        ],
        'al_prof_exam_passed'        => [
            'required',
            'exists:r_professional_exams,profex_id'
        ],
        'al_prof_exam_passed_others' => [
            'string'
        ],
        'al_employment_status'       => [
            'required',
        ],
        'al_first_job_desc'          => [
            'string'
        ],
        'al_first_job_discover'      => [
            'exists:r_first_job_discover,fjd_id'
        ],
        'al_first_job_timeframe'     => [
            'exists:r_first_job_timeframe,fjtf_id'
        ],
        'al_work_place'              => [
            'numeric'
        ],
        'al_work_place_intl'         => [
            'string'
        ],
        'al_self_employ_salary'      => [
            'exists:r_self_employed_salary,se_salary_id'
        ],
    ];

    /**
     * Rules for updating alumni record
     *
     * @var \string[][]
     */
    public $aAlumniUpdate = [
        'al_id'                      => [
            'required',
            'exists:t_alumni,al_id'
        ],
        'al_acc_id'                  => [
            'exists:t_accounts,acc_id'
        ],
        'al_firstname'               => [
            'string'
        ],
        'al_middlename'              => [
            'string'
        ],
        'al_lastname'                => [
            'string'
        ],
        'al_birthdate'               => [
            'string'
        ],
        'al_address'                 => [
            'string'
        ],
        'al_email'                   => [
            'string'
        ],
        'al_tel_num'                 => [
            'string'
        ],
        'al_mobile_num'              => [
            'string'
        ],
        'al_student_num'             => [
            'string'
        ],
        'al_civil_status'            => [
            'numeric',
        ],
        'al_course_id'               => [
            'exists:r_courses,course_id'
        ],
        'al_year_graduated'          => [
            'numeric',
        ],
        'al_honors_received'         => [
            'exists:r_honors_received,honor_id'
        ],
        'al_educ_attainment'         => [
            'exists:r_educational_attainment,educ_attain_id'
        ],
        'al_educ_attainment_others'  => [
            'string'
        ],
        'al_prof_exam_passed'        => [
            'exists:r_professional_exams,profex_id'
        ],
        'al_prof_exam_passed_others' => [
            'string'
        ],
        'al_employment_status'       => [
            'numeric',
        ],
        'al_first_job_desc'          => [
            'string'
        ],
        'al_first_job_discover'      => [
            'exists:r_first_job_discover,fjd_id'
        ],
        'al_first_job_timeframe'     => [
            'exists:r_first_job_timeframe,fjtf_id'
        ],
        'al_work_place'              => [
            'numeric'
        ],
        'al_work_place_intl'         => [
            'string'
        ],
        'al_self_employ_salary'      => [
            'exists:r_self_employed_salary,se_salary_id'
        ],
    ];
}
