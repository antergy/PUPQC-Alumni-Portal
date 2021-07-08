<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionValidator extends BaseValidator
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
            'fq_sequence_no'   => [
                'required'
            ],
            'fq_desc'          => [
                'required'
            ],
            'fq_fqg_id'        => [
                'required'
            ],
            'fq_fqt_id'        => [
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
            'fq_sequence_no.required' => 'Question sequence number is required',
            'fq_desc.required'        => 'Question description is required',
            'fq_fqg_id.required'      => 'Question group ID is required',
            'fq_fqt_id.required'      => 'Question Type ID is required'
        ];
    }
}
