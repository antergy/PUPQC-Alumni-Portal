<?php


namespace App\Http\Repositories\Form_Management;

use App\Core\API\CoreApiRepository;

/**
 * Class FormRepository
 *
 * @package App\Http\Repositories\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class FormRepository extends CoreApiRepository
{
    /**
     * Table name
     *
     * @var string
     */
    public $sTableName = 'r_form';

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
    public $sPrimaryKey = 'form_id';

    /**
     * Columns that are allowed to be used as search parameters
     *
     * @var string[]
     */
    public $aSearch = [
        'form_id',
        'form_desc',
        'form_degree_id',
        'form_course_id',
        'form_active_status',
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

    /**
     * Inner join the degree table
     *
     * @param string $sType
     */
    public function joinDegreeTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form.form_degree_id';
        $sForeignKey = 'r_degree.degree_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_degree', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }

    /**
     * Inner join the courses table
     *
     * @param string $sType
     */
    public function joinCourseTable($sType = 'inner')
    {
        $sReferenceKey = 'r_form.form_course_id';
        $sForeignKey = 'r_courses.course_id';
        $sOperator = '=';
        $this->oModel = $this->oModel->join('r_courses', $sReferenceKey, $sOperator, $sForeignKey, $sType);
    }
}

