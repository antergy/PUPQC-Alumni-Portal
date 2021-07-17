<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AccountManagementService;
use App\Http\Services\Front\AuthService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class RegistrationPageController
 * @package App\Http\Controllers\Front
 */
class RegistrationPageController extends Controller
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
     * Holds the instance of auth service
     * @var AuthService
     */
    public $oAuthService;

    /**
     * RegistrationPageController constructor.
     * @param Request $oRequest
     * @param AccountManagementService $oAccountAdminService
     * @param AuthService $oAuthService
     *
     */
    public function __construct(Request $oRequest, AccountManagementService $oAccountAdminService, AuthService $oAuthService)
    {
        $this->oRequest = $oRequest;
        $this->oAccountAdminService = $oAccountAdminService;
        $this->oAuthService = $oAuthService;

    }

    /**
     * Registers the alumni account
     *
     * @return array
     */
    public function register()
    {
        /** Initialize the action, module, and trace id */
        $sAction = $this->getAction(2);
        $sModule = $this->getModule(1);
        LogLib::initTraceId("register-{$sModule}");

        try {
            /** Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();
            /** Execute request */
            $mResult = $this->oAccountAdminService->actionDivider($sAction, $aParams);
            if ($mResult['code'] === 200) {
                $oAuthController = new AuthController($this->oRequest->merge([
                        'username' => $aParams['acc_username'],
                        'password' => $aParams['acc_password']
                    ]), $this->oAuthService);
                $oAuthController->login();
            }
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
