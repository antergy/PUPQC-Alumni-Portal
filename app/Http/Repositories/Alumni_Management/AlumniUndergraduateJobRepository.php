<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniUndergraduateJobRepository
 * @package App\Http\Repositories\Alumni_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/25/2021
 * @version 1.0
 */
class AlumniUndergraduateJobRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 't_alumni_undergraduate_job';

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
    public $sPrimaryKey = 'auj_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'auj_id',
        'auj_alumni_id',
        'auj_first_job',
        'auj_first_job_discover',
        'auj_first_job_timeframe',
        'auj_first_job_level_position',
        'auj_curr_job_level_position',
        'auj_self_employ_salary',
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
        $sReferenceKey = 't_alumni_undergraduate_job.auj_alumni_id';
        $sForeignKey = 't_alumni.alumni_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
