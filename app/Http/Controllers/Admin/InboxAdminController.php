<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\InboxManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class InboxAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/20/2021
 * @version 1.0
 */
class InboxAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of inbox management service
     * @var InboxManagementService
     */
    public $oInboxManagementService;

    /**
     * InboxAdminController constructor.
     * @param Request $oRequest
     * @param InboxManagementService $oCoreService
     */
    public function __construct(Request $oRequest, InboxManagementService $oInboxManagementService)
    {
        $this->oRequest = $oRequest;
        $this->oInboxManagementService = $oInboxManagementService;
    }

    /**
     * Manages all requests of inbox management related functions
     * @return array
     */
    public function manageRequest()
    {
        /** 1. Initialize the action, module, and trace id */
        $sAction = $this->getAction(2);
        $sModule = $this->getModule(1);
        LogLib::initTraceId($sModule);

        try {
            /** 2. Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();

            /** 3. Execute request */
            $mResult = $this->oInboxManagementService->actionDivider($sAction, $aParams);

            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
