<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class AccountValidator
 * @package App\Http\Validators
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/15/2021
 * @version 1.0
 */
class AccountValidator extends BaseValidator
{
    /**
     * Validates account params
     *
     * @param array $aParams
     * @param string $sAction
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
            'acc_username'        => ['required',
                                      'string'],
            'acc_password'        => ['required',
                                      'string'],
            'acc_name'            => ['required',
                                      'string'],
            'acc_email'           => ['required',
                                      'string'],
            'acc_at_id'           => ['required',
                                      'numeric'],
            'acc_status'          => ['required',
                                      'numeric'],
            'acc_assoc_degree_id' => ['required',
                                      'numeric'],
            'acc_assoc_branch_id' => ['required',
                                      'numeric'],
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
            'acc_username.required' => 'Username is required'
        ];
    }
}
