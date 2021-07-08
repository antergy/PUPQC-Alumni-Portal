<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionGroupValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionGroupValidator extends BaseValidator
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
            'fqg_sequence_no'   => [
                'required'
            ],
            'fqg_desc'          => [
                'required'
            ],
            'fqg_form_id'        => [
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
            'fqg_sequence_no.required' => 'Question group sequence number is required',
            'fqg_desc.required'        => 'Question group description is required',
            'fqg_form_id.required'     => 'Form ID is required'
        ];
    }
}
