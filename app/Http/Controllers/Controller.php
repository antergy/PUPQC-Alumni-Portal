<?php

namespace App\Http\Controllers;

use App\Libraries\Common\GuzzleLib;
use App\Libraries\Common\LogLib;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Gets the requested action based on the request URL
     *
     * @return array|mixed
     */
    protected function getAction()
    {
        $sRequestURL = $this->oRequest->getRequestUri();
        return data_get(explode('/', $sRequestURL), 4);
    }

    /**
     * Gets the requested module based on the request URL
     *
     * @return array|mixed
     */
    protected function getModule()
    {
        $sRequestURL = $this->oRequest->getRequestUri();
        return data_get(explode('/', $sRequestURL), 3);
    }

    /**
     * Sends a guzzle request
     *
     * @param string $sApiModule
     * @param string $sAction
     * @param array $aParams
     * @return array|mixed
     */
    protected function sendGuzzleRequest($sApiRoute, $sMethod, $aParams)
    {
        $sHost = config('app.app_route');
        $sApiUrl = "{$sHost}{$sApiRoute}";
        $aParams = ['json' => array_merge($aParams, ['trace_id' => LogLib::$sTraceId])];

        $mResult = GuzzleLib::guzzleRequest($sApiUrl, $sMethod, $aParams);
        return $mResult;
    }
}
