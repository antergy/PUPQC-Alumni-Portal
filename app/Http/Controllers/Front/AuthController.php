<?php

namespace App\Http\Controllers\Front;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Front\AuthService;
use App\Libraries\Common\AuthLib;
use App\Libraries\Common\SessionLib;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Front
 */
class AuthController extends Controller
{
    public $oRequest;

    public $oAuthService;

    public function __construct(Request $oRequest, AuthService $oAuthService)
    {
       $this->oRequest = $oRequest;
       $this->oAuthService = $oAuthService;
    }

    public function login()
    {
        $sUsername = $this->oRequest->input('username', '');
        $sPassword = $this->oRequest->input('password', '');
        $aFinalResult = [
            AppConstants::CODE     => 200,
            AppConstants::B_RESULT => true,
            AppConstants::MESSAGE  => 'Successfully logged in'
        ];
        $aVerifyResult = $this->oAuthService->checkIfParamsAreEmpty($sUsername, $sPassword);
        if($aVerifyResult[AppConstants::B_RESULT] === false) {
            $aFinalResult = $aVerifyResult;
        } else {
            $aVerifyResult = $this->oAuthService->checkIfAccountExist($sUsername);
            if ($aVerifyResult[AppConstants::B_RESULT] === false) {
                $aFinalResult = $aVerifyResult;
            } else {
                $aVerifyResult = data_get($aVerifyResult, AppConstants::DATA);
                $sDBRetrievedPassword = data_get($aVerifyResult, 'acc_password', '');
                if ($sPassword !== $sDBRetrievedPassword) {
                    $aFinalResult = [
                        AppConstants::CODE     => 200,
                        AppConstants::B_RESULT => false,
                        AppConstants::MESSAGE  => 'Password is Invalid'
                    ];
                } else {
                    $iDBRetrievedUserStatus = data_get($aVerifyResult, 'acc_status', 1);
                    if ($iDBRetrievedUserStatus === 3) {
                        $aFinalResult[AppConstants::CODE] = 200;
                        $aFinalResult[AppConstants::B_RESULT] = false;
                        $aFinalResult[AppConstants::MESSAGE] = "Your Account is Deactivated. \n Please Contact the Administrator to Re-activate your Account";
                    } else {
                        AuthLib::saveUserSession($aVerifyResult);
                        $aAccountInfo = $this->oAuthService->removeSensitiveInfo($aVerifyResult);
                        $aAccountInfo['acc_status'] = 1;
                        $aAccountInfo = array_merge($aAccountInfo, ['user_app_key' => SessionLib::getSession(AuthLib::SECURITY_KEY_1)]);
                        $aFinalResult = array_merge($aFinalResult, [AppConstants::DATA => $aAccountInfo]);
                        $this->oAuthService->setAccStatusToOnline();
                    }
                }
            }
        }

        return $aFinalResult;
    }

    public function getSession()
    {
        return AuthLib::getUserSession();
    }

    public function logout()
    {
        $this->oAuthService->setAccStatusToOffline();
        AuthLib::deleteUserSession();
        return redirect('/');
    }
}
