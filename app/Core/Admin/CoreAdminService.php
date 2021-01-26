<?php

namespace App\Core\Admin;

use App\Libraries\Common\GuzzleLib;
use App\Libraries\Common\LogLib;

/**
 * Class CoreAdminService
 * @package App\Core\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 *
 */
class CoreAdminService
{
    /**
     * Constant for the API version
     */
    const API_VERSION = 'v1';

    /**
     * Sends a internal api guzzle request
     *
     * @param string $sApiModule
     * @param string $sAction
     * @param array $aParams
     * @return array|mixed
     */
    public function sendInternalApiRequest($sApiRoute, $sMethod, $aParams)
    {
        $sHost = config('app.app_route');
        $sApiUrl = "{$sHost}{$sApiRoute}";
        $aParams = ['json' => array_merge($aParams, ['trace_id' => LogLib::$sTraceId])];
        $mResult = GuzzleLib::guzzleRequest($sApiUrl, $sMethod, $aParams);
        return $mResult;
    }
}
