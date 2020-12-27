<?php

namespace App\Libraries\Common;

/**
 * Class ResponseLib
 * @package App\Libraries\Common
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/20/2020
 * @version 1.0
 */
class ResponseLib
{
    /**
     * Returns a formatted response
     *
     * @param int $iCode
     * @param array $mData
     * @param string $sMessage
     * @return array
     */
    public static function formatResponse($iCode = 200, $mData = [], $sMessage = 'n/a')
    {
        return [
            'code'    => $iCode,
            'data'    => $mData,
            'message' => $sMessage
        ];
    }
}
