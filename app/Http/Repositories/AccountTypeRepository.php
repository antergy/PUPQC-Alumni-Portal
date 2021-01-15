<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class AccountTypeRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class AccountTypeRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_account_types';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'at_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'at_id',
        'at_desc'
    ];
}
