<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class BranchRepository
 * @package App\Http\Repositories
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/28/2021
 * @version 1.0
 */
class BranchRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_branch';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'branch_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'branch_id',
        'branch_name',
        'branch_address',
        'status'
    ];
}
