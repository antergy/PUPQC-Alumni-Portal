<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class FirstJobTimeFrameRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class FirstJobTimeFrameRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_first_job_timeframe';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'fjtf_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fjtf_id',
        'fjtf_desc'
    ];
}
