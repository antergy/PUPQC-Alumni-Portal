<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniGraduateJobRepository
 * @package App\Http\Repositories\Alumni_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/25/2021
 * @version 1.0
 */
class AlumniGraduateJobRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 't_alumni_graduate_job';

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
    public $sPrimaryKey = 'agj_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'agj_id',
        'agj_alumni_id',
        'agj_curr_job_title',
        'agj_prev_job_title',
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
        $sReferenceKey = 't_alumni_graduate_job.agj_alumni_id';
        $sForeignKey = 't_alumni.alumni_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
