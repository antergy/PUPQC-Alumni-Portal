<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class EducAttainmentRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class EducAttainmentRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_educational_attainment';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'educ_attain_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'educ_attain_id',
        'educ_attain_desc'
    ];
}
