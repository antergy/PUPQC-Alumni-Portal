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
        'alumni_acc_id'                     => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'alumni_firstname'                  => [
            'required',
            'string'
        ],
        'alumni_middlename'                 => [
            'string'
        ],
        'alumni_lastname'                   => [
            'required',
            'string'
        ],
        'alumni_birthdate'                  => [
            'required',
            'string'
        ],
        'alumni_gender'                     => [
            'required',
            'string'
        ],
        'alumni_address'                    => [
            'required',
            'string'
        ],
        'alumni_email'                      => [
            'required',
            'string'
        ],
        'alumni_tel_num'                    => [
            'string'
        ],
        'alumni_mobile_num'                 => [
            'required',
            'string'
        ],
        'alumni_student_num'                => [
            'string'
        ],
        'alumni_civil_status'               => [
            'required',
            'numeric'
        ],
        'alumni_course_id'                  => [
            'required',
            'exists:r_courses,course_id'
        ],
        'alumni_year_graduated'             => [
            'required',
            'numeric'
        ],
        'alumni_year_grad_complete_program' => [
            'required',
            'string'
        ],
        'alumni_age_graduate_enrolled'      => [
            'required',
            'numeric'
        ],
        'alumni_employ_status'              => [
            'required',
        ],
        'alumni_unemploy_status'            => [
            'required',
        ],
    ];

    /**
     * Rules for updating alumni record
     *
     * @var \string[][]
     */
    public $aAlumniUpdate = [
        'alumni_id'                         => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'alumni_acc_id'                     => [
            'required',
            'exists:t_accounts,acc_id'
        ],
        'alumni_firstname'                  => [
            'required',
            'string'
        ],
        'alumni_middlename'                 => [
            'string'
        ],
        'alumni_lastname'                   => [
            'required',
            'string'
        ],
        'alumni_birthdate'                  => [
            'required',
            'string'
        ],
        'alumni_gender'                     => [
            'required',
            'string'
        ],
        'alumni_address'                    => [
            'required',
            'string'
        ],
        'alumni_email'                      => [
            'required',
            'string'
        ],
        'alumni_tel_num'                    => [
            'string'
        ],
        'alumni_mobile_num'                 => [
            'required',
            'string'
        ],
        'alumni_student_num'                => [
            'string'
        ],
        'alumni_civil_status'               => [
            'required',
            'numeric'
        ],
        'alumni_course_id'                  => [
            'required',
            'exists:r_courses,course_id'
        ],
        'alumni_year_graduated'             => [
            'required',
            'numeric'
        ],
        'alumni_year_grad_complete_program' => [
            'required',
            'string'
        ],
        'alumni_age_graduate_enrolled'      => [
            'required',
            'numeric'
        ],
        'alumni_employ_status'              => [
            'required',
        ],
        'alumni_unemploy_status'            => [
            'required',
        ],
    ];

    /**
     * Rules for creating alumni company profile record
     *
     * @var \string[][]
     */
    public $aAlumniCompanyProfileCreate = [
        'acp_alumni_id'                     => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'company_name'                      => [
            'required',
            'string'
        ],
        'company_address'                   => [
            'required',
            'string'
        ],
        'company_nature'                    => [
            'required',
            'string'
        ],
        'acp_industry_id'                   => [
            'required',
            'exists:r_industry,industry_id'
        ],
        'acp_industry_others'               => [
            'required',
            'string'
        ],
        'acp_department_section'            => [
            'required',
            'string'
        ],
        'acp_work_area'                     => [
            'required',
            'string'
        ],
        'acp_work_status'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni company profile record
     *
     * @var \string[][]
     */
    public $aAlumniCompanyProfileUpdate = [
        'acp_id'                            => [
            'required',
            'exists:t_alumni_company_profile,acp_id'
        ],
        'acp_alumni_id'                     => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'company_name'                      => [
            'required',
            'string'
        ],
        'company_address'                   => [
            'required',
            'string'
        ],
        'company_nature'                    => [
            'required',
            'string'
        ],
        'acp_industry_id'                   => [
            'required',
            'exists:r_industry,industry_id'
        ],
        'acp_industry_others'               => [
            'required',
            'string'
        ],
        'acp_department_section'            => [
            'required',
            'string'
        ],
        'acp_work_area'                     => [
            'required',
            'string'
        ],
        'acp_work_status'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni graduate job record
     *
     * @var \string[][]
     */
    public $aAlumniGraduateJobCreate = [
        'agj_alumni_id'                        => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'agj_curr_job_title'                   => [
            'required',
            'string'
        ],
        'agj_prev_job_title'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni graduate job record
     *
     * @var \string[][]
     */
    public $aAlumniGraduateJobUpdate = [
        'agj_id'                               => [
            'required',
            'exists:t_alumni_graduate_job,agj_id'
        ],
        'agj_alumni_id'                        => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'agj_curr_job_title'                   => [
            'required',
            'string'
        ],
        'agj_prev_job_title'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni graduate thesis record
     *
     * @var \string[][]
     */
    public $aAlumniGraduateThesisCreate = [
        'agt_alumni_id'                 => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'agt_title'                     => [
            'required',
            'string'
        ],
        'agt_adviser'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni graduate thesis record
     *
     * @var \string[][]
     */
    public $aAlumniGraduateThesisUpdate = [
        'agt_id'                        => [
            'required',
            'exists:t_alumni_graduate_thesis,agt_id'
        ],
        'agt_alumni_id'                 => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'agt_title'                     => [
            'required',
            'string'
        ],
        'agt_adviser'                   => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni undergraduate job record
     *
     * @var \string[][]
     */
    public $aAlumniUndergraduateJobCreate = [
        'auj_alumni_id'                => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'auj_first_job'                => [
            'required',
            'string'
        ],
        'auj_first_job_discover'       => [
            'required',
            'string'
        ],
        'auj_first_job_timeframe'      => [
            'required',
            'string'
        ],
        'auj_first_job_level_position' => [
            'required',
            'string'
        ],
        'auj_curr_job_level_position'  => [
            'required',
            'string'
        ],
        'auj_self_employ_salary'       => [
            'required',
            'string'
        ],
    ];

    /**
     * Rules for updating alumni undergraduate job record
     *
     * @var \string[][]
     */
    public $aAlumniUndergraduateJobUpdate = [
        'auj_id'                       => [
            'required',
            'exists:t_alumni_undergraduate_job,auj_id'
        ],
        'auj_alumni_id'                => [
            'required',
            'exists:t_alumni,alumni_id'
        ],
        'auj_first_job'                => [
            'required',
            'string'
        ],
        'auj_first_job_discover'       => [
            'required',
            'string'
        ],
        'auj_first_job_timeframe'      => [
            'required',
            'string'
        ],
        'auj_first_job_level_position' => [
            'required',
            'string'
        ],
        'auj_curr_job_level_position'  => [
            'required',
            'string'
        ],
        'auj_self_employ_salary'       => [
            'required',
            'string'
        ],
    ];
}
