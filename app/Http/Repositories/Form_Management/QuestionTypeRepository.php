<?php

namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class QuestionTypeRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/10/2021
 * @version 1.0
 */
class QuestionTypeRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form_question_type';

    /**
     * Foreign table columns to displayed in the result
     *
     * @var string[]
     */
    public $aForeignColumns = [
        //
    ];

    /**
     * Primary key of the table
     *
     * @var string
     */
    public $sPrimaryKey = 'fqt_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'fqt_id',
        'fqt_desc',
    ];

    /**
     * Fields allowed to be filtered by "LIKE"
     * @var string[]
     */
    public $aFieldsLikeAllowed = [
    ];

    /**
     * Columns that are encrypted
     *
     * @var string[]
     */
    public $aEncryptedKeys = [
        //
    ];
}
