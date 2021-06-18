<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniCompanyProfileRepository
 * @package App\Http\Repositories\Alumni_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/25/2021
 * @version 1.0
 */
class AlumniCompanyProfileRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 't_alumni_company_profile';

    /**
     * Foreign table columns to displayed in the result
     *
     * @var string[]
     */
    public $aForeignColumns = [
        //
    ];

    /**
     * Primary key of the table
     *
     * @var string
     */
    public $sPrimaryKey = 'acp_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'acp_id',
        'acp_alumni_id',
        'acp_company_name',
        'acp_company_address',
        'acp_company_nature',
        'acp_industry_id',
        'acp_industry_others',
        'acp_department_section',
        'acp_work_area',
        'acp_work_status',
    ];

    /**
     * Fields allowed to be filtered by "LIKE"
     * @var string[]
     */
    public $aFieldsLikeAllowed = [
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        //
    ];

    /**
     * Inner join the alumni table
     *
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_company_profile.acp_alumni_id';
        $sForeignKey = 't_alumni.alumni_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the industry table
     *
     * @param string $sType
     */
    public function joinIndustryTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_company_profile.acp_industry_id';
        $sForeignKey = 'r_industry.industry_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_industry', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
