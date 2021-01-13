<?php

namespace App\Libraries\API;

/**
 * Class ArrayLib
 * @package App\Libraries\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class ArrayLib
{
    /**
     * filters array keys
     *
     * @param array $aData
     * @param array $aKeys
     * @return array
     */
    public static function filterKeys($aData, $aKeys)
    {
        return array_intersect_key($aData, array_flip($aKeys));
    }
}
