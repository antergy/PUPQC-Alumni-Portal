<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AccountManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class AccountAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 */
class AccountAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var AccountManagementService
     */
    public $oAccountAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param AccountManagementService $oAccountAdminService
     */
    public function __construct(Request $oRequest, AccountManagementService $oAccountAdminService)
    { $this->oRequest = $oRequest;
        $this->oAccountAdminService = $oAccountAdminService;

    }

    /**
     * Manages all account management request from sys ad's perspective
     *
     * @return array
     */
    public function manageRequest()
    {
        /** Initialize the action, module, and trace id */
        $sAction = $this->getAction(2);
        $sModule = $this->getModule(1);
        LogLib::initTraceId("sys_admin-{$sModule}");

        try {
            /** Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oAccountAdminService->actionDivider($sAction, $aParams);
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
