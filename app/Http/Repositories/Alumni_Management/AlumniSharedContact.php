<?php

namespace App\Http\Repositories\Alumni_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class AlumniSharedContact
 * @package App\Http\Repositories\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/02/2021
 * @version 1.0
 */
class AlumniSharedContact extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_alumni_shared_contact';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'asc_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'al_firstname' => 't_alumni',
        'al_lastname'  => 't_alumni',
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'asc_id',
        'asc_shared_by',
        'asc_name',
        'asc_email',
        'asc_contact_num'
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        'asc_name',
        'asc_email',
        'asc_contact_num'
    ];

    /**
     * Inner join the alumni table
     * @param string $sType
     */
    public function joinAlumniTable($sType = 'inner')
    {
        $sReferenceKey = 't_alumni_shared_contact.asc_shared_by';
        $sForeignKey = 't_alumni.al_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_alumni', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
