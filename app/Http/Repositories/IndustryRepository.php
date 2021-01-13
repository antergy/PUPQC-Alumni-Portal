<?php


namespace App\Http\Repositories;


use App\Core\API\CoreApiRepository;

/**
 * Class IndustryRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class IndustryRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_industry';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'industry_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'industry_id',
        'industry_desc'
    ];
}
