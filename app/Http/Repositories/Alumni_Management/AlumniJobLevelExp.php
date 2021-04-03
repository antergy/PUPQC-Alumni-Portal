<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniJobLevelExp
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniJobLevelExp extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_job_level_exp';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'ajle_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'jlc_desc' => 'r_job_level_classification'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'ajle_id',
        'ajle_alumni_id',
        'ajle_job_level_id',
        'ajle_occurence',
    ];

    /**
     * Join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_job_level_exp.ajle_alumni_id';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the job level classification reference table
     * @param string $sType
     */
    public function joinJobLevelTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_job_level_exp.ajle_job_level_id';
        $sForeignKey = 'r_job_level_classification.jlc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_job_level_classification', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
