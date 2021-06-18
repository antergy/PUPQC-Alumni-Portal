<?php


namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class DegreeRepository
 * @package App\Http\Repositories
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class DegreeRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_degree';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'degree_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'degree_id',
        'degree_desc'
    ];
}

