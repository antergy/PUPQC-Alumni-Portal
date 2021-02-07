<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniCompetencies
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniCompetencies extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_competencies';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'alcom_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'competency_desc' => 'r_competencies'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'alcom_id',
        'alcom_alumni_id',
        'alcom_competency',
        'alcom_acquire_level',
        'alcom_relevant_level'
    ];

    /**
     * Join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_competencies.alcom_alumni_id';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the competency reference table
     * @param string $sType
     */
    public function joinCompetencyTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_competencies.alcom_competency';
        $sForeignKey = 'r_competencies.competency_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_competencies', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
