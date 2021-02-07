<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniUnemployedReason
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniUnemployedReason extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_unemployed_reason';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'aur_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'ur_desc' => 'r_unemployment_reason'
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'aur_id',
        'aur_alumni_id',
        'aur_unemploy_reason',
        'aur_other_desc',
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'aur_other_desc'
    ];

    /**
     * Join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_unemployed_reason.aur_alumni_id';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Join the unemployed reason reference table
     * @param string $sType
     */
    public function joinUnEmployReasonTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_unemployed_reason.aur_unemploy_reason';
        $sForeignKey = 'r_unemployment_reason.ur_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_unemployment_reason', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
