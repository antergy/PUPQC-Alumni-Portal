<?php

namespace App\Libraries\Common;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Class LogLib
 * @package App\Libraries\Common
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class GuzzleLib
{
    /**
     * Executes guzzle request
     *
     * @param string $sUrl
     * @param string $sMethod
     * @param array  $aOption
     * @return array|mixed
     */
    public static function guzzleRequest($sUrl, $sMethod = 'GET', $aOption = [])
    {
        $aConfig = [
            'verify' => false
        ];
        $oClient = new Client($aConfig);

        try {
            $sResult = $oClient->request($sMethod, $sUrl, $aOption)->getBody()->getContents();
            LogLib::LogProcesses($sMethod, $sUrl, $aOption, 'Successfully executed the request');
            return json_decode($sResult, true);
        } catch (GuzzleException $oException) {
            report($oException);
            $oResponse = $oException->getResponse();
            $bNoResponse = is_null($oException->getResponse());
            $iCode = $bNoResponse === true ? $oException->getCode() : $oResponse->getStatusCode();
            $sMessage = $bNoResponse === true ? $oException->getMessage() : $oResponse->getReasonPhrase();
            $mBody = $bNoResponse === true ? $oException->getRequest()->getBody() : $oResponse->getBody();

            LogLib::LogProcesses($sMethod, $sUrl, $aOption, $sMessage, 'Failed');
            return [
                'code'    => $iCode,
                'message' => $sMessage,
                'data'    => $mBody
            ];
        }
    }
}
