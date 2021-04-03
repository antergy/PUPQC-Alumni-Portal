<?php

namespace App\Http\Repositories;

use App\Core\API\CoreApiRepository;

/**
 * Class CourseRepository
 * @package App\Http\Repositories
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/06/2021
 * @version 1.0
 */
class CourseRepository extends CoreApiRepository
{
    /**
     * Table name
     * @var string
     */
    public $sTableName = 'r_courses';

    /**
     * Primary key of the table
     * @var string
     */
    public $sPrimaryKey = 'course_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'course_id',
        'course_desc',
        'course_acronym'
    ];
}
