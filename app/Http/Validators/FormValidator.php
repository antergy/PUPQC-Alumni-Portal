<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class FormValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class FormValidator extends BaseValidator
{
    /**
     * Validates form params
     *
     * @param array $aParams
     * @return array|bool[]
     */
    public static function validate($aParams)
    {
        $oValidator = Validator::make($aParams, self::rules(), self::customMessage());

        return BaseValidator::checkValidationSuccess($oValidator);
    }

    /**
     * Defines the validation rules
     *
     * @return \string[][]
     */
    private static function rules()
    {
        return [
            'form_desc'          => [
                'required',
                'string'
            ],
            'form_degree_id'     => [
                'required'
            ],
            'form_course_id'     => [
                'required'
            ]
        ];
    }

    /**
     * Defines the custom messages per validation rule
     *
     * @return string[]
     */
    private static function customMessage()
    {
        return [
            'form_desc.required'      => 'Form description is required',
            'form_degree_id.required' => 'Degree ID is required',
            'form_course_id.required' => 'Course ID is required'
        ];
    }
}
