<?php


namespace App\Http\Validators;


use Illuminate\Support\Facades\Validator;

/**
 * Class PostValidator
 * @package App\Http\Validators
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/25/2021
 * @version 1.0
 */
class PostValidator extends BaseValidator
{
    /**
     * Validates post params
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
            'p_id'        => ['integer'],
            'p_title'     => ['required',
                              'string'],
            'p_desc'      => ['required',
                              'string'],
            'p_picture'   => ['string'],
            'p_acc_id'    => ['required',
                              'numeric'],
            'p_type_id'   => ['required',
                              'numeric'],
            'p_course_id' => ['numeric'],
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
            'p_title.required' => 'Post title is required'
        ];
    }
}
