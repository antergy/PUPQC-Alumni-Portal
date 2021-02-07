<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniImpactEducation
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniImpactEducation extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_impact_education';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'aled_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'aled_id',
        'aled_alumni_id',
        'aled_impact_education',
        'aled_rating'
    ];

    /**
     * Join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_impact_education.aled_alumni_id';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the impact of education reference table
     * @param string $sType
     */
    public function joinImpactEducationTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_impact_education.aled_alumni_id';
        $sForeignKey = 'r_impact_of_education.ioe_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_impact_of_education', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
