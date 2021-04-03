<?php

namespace App\Http\Validators;

/**
 * Class BaseValidator
 * @package App\Http\Validators
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/15/2021
 * @version 1.0
 */
class BaseValidator
{
    /**
     * Checks the validation if there are no errors
     *
     * @param object $oValidator
     * @return array|bool[]
     */
    public static function checkValidationSuccess($oValidator)
    {
        if ($oValidator->fails()) {
            return [
                'data'    => false,
                'message' => self::getErrorMessages($oValidator)
            ];
        }

        return [
            'data' => true
        ];
    }

    /**
     * Compiles error messages
     *
     * @param object $oValidator
     * @return string
     */
    protected static function getErrorMessages($oValidator)
    {
        $oErrors = $oValidator->errors();
        $aErrorMessages = [];

        foreach ($oErrors->all() as $sMessage) {
            array_push($aErrorMessages, $sMessage);
        }

        return implode('; ', $aErrorMessages);
    }
}
