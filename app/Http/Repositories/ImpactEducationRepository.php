<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class ImpactEducationRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class ImpactEducationRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_impact_of_education';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'ioe_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'ioe_id',
        'ioe_desc'
    ];
}
