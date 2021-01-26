<?php

namespace App\Http\Controllers\Admin;

use App\Core\Admin\CoreAdminService;
use App\Http\Controllers\Controller;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class SystemAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class SystemAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of core admin service
     * @var CoreAdminService
     */
    public $oCoreService;

    /**
     * SystemAdminController constructor.
     * @param Request $oRequest
     * @param CoreAdminService $oCoreService
     */
    public function __construct(Request $oRequest, CoreAdminService $oCoreService)
    {
        $this->oRequest = $oRequest;
        $this->oCoreService = $oCoreService;
    }

    /**
     * Manages all requests of system administrator's functions
     * @return array
     */
    public function manageRequest()
    {
        /** 1. Initialize the action, module, and trace id */
        $sAction = $this->getAction();
        $sModule = $this->getModule();
        LogLib::initTraceId("sys_admin-{$sModule}");

        try {
            /** 2. Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();
            $sApiRoute = "/v1/{$sModule}/{$sAction}";
            $sMethod = $sAction === 'read' ? 'GET' : 'POST';

            /** 3. Execute request */
            $mResult = $this->oCoreService->sendInternalApiRequest($sApiRoute, $sMethod, $aParams);

            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
