<?php

namespace App\Http\Rules\API;

/**
 * Class CourseRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/06/2021
 * @version 1.0
 */
class CourseRules
{
    /**
     * Rules for creating course record
     *
     * @var \string[][]
     */
    public $aCourseCreate = [
        'course_desc' => [
            'required',
            'max:225'
        ],
        'course_acronym' => [
            'required',
            'max:20'
        ],
    ];
}
