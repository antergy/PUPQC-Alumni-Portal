<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class LikeValidator
 * @package App\Http\Validators
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/26/2021
 * @version 1.0
 */
class LikeValidator extends BaseValidator
{
    /**
     * Validates like params
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
            'lk_id'      => ['numeric'],
            'lk_post_id' => ['numeric',
                             'required'],
            'lk_acc_id'  => ['numeric',
                             'required'],
            'lk_status'  => ['numeric']
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
            'lk_post_id.required' => 'Post ID is required'
        ];
    }
}
