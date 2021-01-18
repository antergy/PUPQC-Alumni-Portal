<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class VisitLogsRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/15/2021
 * @version 1.0
 */
class VisitLogsRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 't_visit_logs';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'vs_id';

    /**
     * Foreign table columns to displayed in the result
     * @var string[]
     */
    public $aForeignColumns = [
        'acc_username' => 't_accounts',
    ];

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'vs_id',
        'vs_acc_id',
        't_visit_logs.created_at'
    ];

    /**
     * Inner join the account table
     * @param string $sType
     */
    public function joinAccountTable($sType = 'inner')
    {
        $sReferenceKey = 't_visit_logs.vs_acc_id';
        $sForeignKey = 't_accounts.acc_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('t_accounts', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}
