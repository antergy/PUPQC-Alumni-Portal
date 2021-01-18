<?php


namespace App\Libraries\Common;

use Illuminate\Support\Facades\Log;

/**
 * Class LogLib
 * @package App\Libraries\Common
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class LogLib
{
    /**
     * Constant for trace id field
     */
    const TRACE_ID = 'trace_id';

    /**
     * Default trace id if there none given
     */
    const DEFAULT_TRACE_ID = 'null-0000';

    /**
     * Constant for non specified module
     */
    const MODULE = 'not_specified';

    /**
     * Constant for module
     */
    const MODULE_KEY = 'module';

    /**
     * Constant for requests type
     */
    const REQUEST_TYPE_KEY = 'request_type';

    /**
     * Constant default component type if not specified
     */
    const COMPONENT_TYPE = 'admin';

    /**
     * Holds the value of trace id
     * @var string
     */
    public static $sTraceId = '';

    /**
     * Initializes trace id
     * @param string $sModule
     */
    public static function  initTraceId($sModule = self::MODULE)
    {
        $sTraceNumber = date('Ymd_his_').uniqid();
        self::$sTraceId = "{$sModule}-{$sTraceNumber}";
    }

    /**
     * Logs the processes (guzzle requests) from front and admin components
     *
     * @param string $sMethod
     * @param string $sApiUrl
     * @param array  $aParameters
     * @param string $sMessage
     * @param string $aResult
     */
    public static function LogProcesses($sMethod, $sApiUrl, $aParameters = [], $sMessage = 'None', $aResult = 'Success')
    {
        /** 1. Initialize the variables for primary log information */
        $sTraceIdValue = self::$sTraceId;
        $sTraceID = "Trace_Id: [{$sTraceIdValue}];";
        $sModule = sprintf('Module: %s;', data_get(explode('-', $sTraceIdValue), 0));
        $sRequestType = sprintf('Request Method: %s;', $sMethod);
        $sRequestURL = sprintf('Request URL: %s;', $sApiUrl);

        /** 2. Initialize the variables for secondary log information */
        if (array_key_exists('json', $aParameters) === true) {
            unset($aParameters['json']['trace_id']); // Remove trace id in logging
        }
        $sRequestParameters = sprintf("Request Parameters: %s;", \GuzzleHttp\json_encode($aParameters));
        $sResult = sprintf("Result: %s;", json_encode($aResult));
        $sProcessMessage = "Message: {$sMessage}";

        /** 3. Build the primary and secondary log info individually */
        $sPrimaryLogInfo = "{$sTraceID} {$sModule} {$sRequestType} {$sRequestURL}";
        $sSecondaryLogInfo = "{$sRequestParameters} {$sResult} {$sProcessMessage}";

        /** 4. Combine the primary and secondary log info, then execute logging */
        $sCompleteLogMessage = "{$sPrimaryLogInfo} {$sSecondaryLogInfo}";
        Log::channel(self::COMPONENT_TYPE)->info($sCompleteLogMessage);
    }

    /**
     * Logs API processes
     *
     * @param array  $aProcessInfo
     * @param string $sQuery
     * @param string $sMessage
     * @param string[] $aResult
     */
    public static function LogAPI($aProcessInfo, $sQuery, $sMessage = 'Request in process', $aResult = ['none'])
    {
        /** 1. Initialize the variables for primary log information */
        $sTraceIdValue = self::$sTraceId;
        $sTraceID = "Trace_Id: [{$sTraceIdValue}];";
        $sModule = sprintf('Module: %s;', data_get($aProcessInfo, self::MODULE_KEY, self::MODULE));
        $sRequestType = sprintf('Request_Type: Query %s;', data_get($aProcessInfo, self::REQUEST_TYPE_KEY, 'Request'));

        /** 2. Initialize the variables for secondary log information */
        $sQueryStatement = "SQL Query: {$sQuery};";
        $sResult = sprintf("Result: %s;", json_encode($aResult));
        $sProcessMessage = "Message: {$sMessage}";

        /** 3. Build the primary and secondary log info individually */
        $sPrimaryLogInfo = "{$sTraceID} {$sModule} {$sRequestType}";
        $sSecondaryLogInfo = "{$sQueryStatement} {$sResult} {$sProcessMessage}";

        /** 4. Combine the primary and secondary log info, then execute logging */
        $sCompleteLogMessage = "{$sPrimaryLogInfo} {$sSecondaryLogInfo}";
        Log::channel('api')->info($sCompleteLogMessage);
    }
}
