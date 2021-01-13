<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class SelfEmployedSalaryRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class SelfEmployedSalaryRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_self_employed_salary';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'se_salary_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'se_salary_id',
        'se_salary_desc'
    ];
}
