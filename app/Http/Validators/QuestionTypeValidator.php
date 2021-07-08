<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionTypeValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionTypeValidator extends BaseValidator
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
            'fqt_desc'   => [
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
            'fqt_desc.required' => 'Form question type description is required'
        ];
    }
}
