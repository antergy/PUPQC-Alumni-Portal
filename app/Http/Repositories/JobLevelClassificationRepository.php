<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class JobLevelClassificationRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class JobLevelClassificationRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_job_level_classification';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'jlc_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'jlc_id',
        'jlc_desc'
    ];
}
