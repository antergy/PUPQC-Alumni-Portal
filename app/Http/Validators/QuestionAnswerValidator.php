<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionAnswerValidator
 * @package App\Http\Validators
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionAnswerValidator extends BaseValidator
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
            'fa_answer'    => [
                'required'
            ],
            'fa_fq_id'     => [
                'required'
            ],
            'fa_acc_id'    => [
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
            'fa_answer.required' => 'Answer is required',
            'fa_fq_id.required'  => 'Question ID is required',
            'fa_acc_id.required' => 'Account ID is required'
        ];
    }
}
