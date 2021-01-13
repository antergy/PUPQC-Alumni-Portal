<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class FirstJobDiscoverRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class FirstJobDiscoverRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_first_job_discover';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'fjd_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fjd_id',
        'fjd_desc'
    ];
}
