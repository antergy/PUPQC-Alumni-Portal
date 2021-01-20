<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class MessageValidator
 * @package App\Http\Validators
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/20/2021
 * @version 1.0
 */
class MessageValidator extends BaseValidator
{
    /**
     * Validates message params
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
            'in_subject'     => ['required',
                                 'string'],
            'in_message'     => ['required',
                                 'string'],
            'in_acc_id_from' => ['required',
                                 'numeric'],
            'in_acc_id_to'   => ['required',
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
            'in_subject.required'     => 'Message subject is required',
            'in_message.required'     => 'Message content is required',
            'in_acc_id_to.required'   => 'There is no sender specified',
            'in_acc_id_from.required' => 'There is no recipient specified',
        ];
    }
}
