<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\VisitLogsManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class VisitLogAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/18/2021
 * @version 1.0
 */
class VisitLogAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of visit logs management service
     * @var VisitLogsManagementService
     */
    public $oVisitLogsService;

    /**
     * VisitLogAdminController constructor.
     * @param Request $oRequest
     * @param VisitLogsManagementService $oVisitLogsService
     */
    public function __construct(Request $oRequest, VisitLogsManagementService $oVisitLogsService)
    {
        $this->oRequest = $oRequest;
        $this->oVisitLogsService = $oVisitLogsService;
        /** Initialize the trace id */
        LogLib::initTraceId("sys_admin_visit_logs");
    }

    /**
     * Retrieves logs
     *
     * @return array
     */
    public function retrieveLogs()
    {
        try {
            /** Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();
            /** Execute request */
            $mResult = $this->oVisitLogsService->readLogs($aParams);
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
