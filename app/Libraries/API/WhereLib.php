<?php

namespace App\Libraries\API;

/**
 * Class ArrayLib
 * @package App\Libraries\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class WhereLib
{
    /**
     * Constant value for separator
     */
    const SEPARATOR = '-';

    /**
     * Operators to be used in query conditions
     *
     * @var string[]
     */
    private static $aOperators = [
        '-'    => '=',
        // equals to
        'not'  => '<>',
        // not equal to
        'less' => '<',
        // less than
        'more' => '>',
        // greater than
        'like' => 'like'
        // like
    ];

    /**
     * Create an array of query condition
     *
     * @param array $aData
     * @return array
     */
    public static function makeArray($aData)
    {
        $aWhere = [];

        foreach ($aData as $sKey => $sValue) {
            $aKey = explode(self::SEPARATOR, $sKey);
            $sSuffix = data_get($aKey, 1, self::SEPARATOR);
            array_push($aWhere, [$aKey[0], data_get(self::$aOperators, $sSuffix), $sValue]);
        }

        return $aWhere;
    }
}
