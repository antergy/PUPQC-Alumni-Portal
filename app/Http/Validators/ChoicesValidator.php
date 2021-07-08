<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class ChoicesValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class ChoicesValidator extends BaseValidator
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
            'fqc_desc'          => [
                'required'
            ],
            'fqc_fq_id'         => [
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
            'fqc_desc.required'  => 'Choice description is required',
            'fqc_fq_id.required' => 'Question ID is required'
        ];
    }
}
