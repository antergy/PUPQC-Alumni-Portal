<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class UnemploymentReasonRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class UnemploymentReasonRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_unemployment_reason';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'ur_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'ur_id',
        'ur_desc'
    ];
}
