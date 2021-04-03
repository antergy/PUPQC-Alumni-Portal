<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniWorkExperience
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniWorkExperience extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_work_experience';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'awe_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'industry_desc' => 'r_industry'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'awe_id',
        'awe_alumni_id',
        'awe_company_name',
        'awe_company_address',
        'awe_company_nature',
        'awe_company_nature_others',
        'awe_industry_nature',
        'awe_industry_nature_others'
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'awe_company_nature_others',
        'awe_industry_nature_others'
    ];

    /**
     * Join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_work_experience.awe_alumni_id';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the industry reference table
     * @param string $sType
     */
    public function joinIndustryTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_work_experience.awe_industry_nature';
        $sForeignKey = 'r_industry.industry_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_industry', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
