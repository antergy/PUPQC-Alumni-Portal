<?php

namespace App\Http\Controllers\Front;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AccountManagementService;
use App\Http\Services\Front\AuthService;
use App\Http\Services\Front\GoogleService;
use App\Libraries\Common\AuthLib;
use App\Libraries\Common\ResponseLib;
use App\Libraries\Common\SessionLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class AuthController
 * @package App\Http\Controllers\Front
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   03/15/2021
 * @version 1.0
 */
class AuthController extends Controller
{
    /**
     * Holds the instance of Http Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of the auth service
     * @var AuthService
     */
    public $oAuthService;

    public $oGoogleClient;

    /**
     * AuthController constructor.
     *
     * @param Request $oRequest
     * @param AuthService $oAuthService
     */
    public function __construct(Request $oRequest, AuthService $oAuthService)
    {
       $this->oRequest = $oRequest;
       $this->oGoogleClient = new GoogleService();
       $this->oAuthService = $oAuthService;
    }

    public function signUpGoogleByForm()
    {

        $sUrl = 'https://pupqc.alumni-portal.com/tracerIntro';
        $sGoogleToken = SessionLib::getSession('google_access_token');
        $sRedirectUri = 'https://pupqc.alumni-portal.com/signUpGoogleByForm';

        if (empty($sGoogleToken)) {
            if ($this->oGoogleClient->authenticate(2, $sRedirectUri) === true) {
                return Redirect::to($sRedirectUri);
            } else {
                return $this->oGoogleClient->authenticate(2, $sRedirectUri);
            }
        } else {
            // Get google user client
            $client = $this->oGoogleClient->getUserClient($sRedirectUri);
            $res = new \Google\Service\Oauth2($client);
            $aUserDetails = [
                'name' => $res->userinfo->get()->name,
                'email' => $res->userinfo->get()->email,
            ];

            // check if user's email is existing
            $aDataSession = [];
            $aResult = $this->oAuthService->checkIfAccountExistByEmail($aUserDetails['email']);
            if ($aResult['bResult'] === false) {
                $oAccMgtService = new AccountManagementService();
                $aParams = [
                    'acc_username'        => str_replace(' ', '_', $aUserDetails['name']),
                    'acc_name'            => $aUserDetails['name'],
                    'acc_email'           => $aUserDetails['email'],
                    'acc_at_id'           => 2,
                    'acc_google_account'  => 1,
                    'acc_ans_tracer_form' => 0,
                    'at_desc'             => 'Alumni',
                ];

                $aResult = $oAccMgtService->createAccount($aParams);
                $aDataSession = array_merge(['acc_id' => $aResult['data']], $aParams);
            } else {
                $aDataSession = $aResult['data'];
            }
            AuthLib::saveUserSession($aDataSession);
            $aAccountInfo = data_get($this->oAuthService->removeSensitiveInfo($aResult), 'data', []);
            $aAccountInfo['acc_status'] = 1;
//            $aAccountInfo = array_merge($aAccountInfo, ['user_app_key' => SessionLib::getSession(AuthLib::SECURITY_KEY_1)]);
            $this->oAuthService->setAccStatusToOnline();


            return Redirect::to('/tracerIntro'); // This is working as of 5:02pm
        }
    }
    public function loginGoogle()
    {
        $sUrl = 'https://pupqc.alumni-portal.com/home' ;
        $sGoogleToken = SessionLib::getSession('google_access_token');
        $sRedirectUri = 'https://pupqc.alumni-portal.com/loginGoogle';

        if (empty($sGoogleToken)) {
            if ($this->oGoogleClient->authenticate(2, $sRedirectUri) === true) {
                return Redirect::to('https://pupqc.alumni-portal.com/loginGoogle');
            } else {
                return $this->oGoogleClient->authenticate(2, $sRedirectUri);
            }
        } else {
            // Get google user client
            $client = $this->oGoogleClient->getUserClient($sRedirectUri);
            $res = new \Google\Service\Oauth2($client);
            $aUserDetails = [
              'name' => $res->userinfo->get()->name,
              'email' => $res->userinfo->get()->email,
              'pic' => $res->userinfo->get()->getPicture()
            ];

            // check if user's email is existing
            $aDataSession = [];
            $aResult = $this->oAuthService->checkIfAccountExistByEmail($aUserDetails['email']);
            if ($aResult['bResult'] === false) {
                $oAccMgtService = new AccountManagementService();
                $aParams = [
                    'acc_username'        => str_replace(' ', '_', $aUserDetails['name']),
                    'acc_name'            => $aUserDetails['name'],
                    'acc_email'           => $aUserDetails['email'],
                    'acc_at_id'           => 2,
                    'acc_google_account'  => 1,
                    'acc_ans_tracer_form' => 0,
                    'at_desc'             => 'Alumni',
                    'acc_picture'         => $aUserDetails['pic']
                 ];

                $aResult = $oAccMgtService->createAccount($aParams);
                $aDataSession = array_merge(['acc_id' => $aResult['data']], $aParams);
            } else {
                $aDataSession = $aResult['data'];
            }

            AuthLib::saveUserSession($aDataSession);
            $aAccountInfo = data_get($this->oAuthService->removeSensitiveInfo($aResult), 'data', []);
            $aAccountInfo['acc_status'] = 1;
            $aAccountInfo = array_merge($aAccountInfo, ['user_app_key' => SessionLib::getSession(AuthLib::SECURITY_KEY_1)]);
            $this->oAuthService->setAccStatusToOnline();

            return Redirect::to('/home'); // This is working as of 5:02pm
        }
    }

    /**
     * User login method
     *
     * @return array
     */
    public function login()
    {
        /** Retrieve username and password user inputs */
        $sUsername = $this->oRequest->input('username', '');
        $sPassword = $this->oRequest->input('password', '');

        /** Set final-result default response */
        $aFinalResult = [
            AppConstants::CODE     => 200,
            AppConstants::B_RESULT => true,
            AppConstants::MESSAGE  => 'Successfully logged in'
        ];

        /** 1st Validation Process: Check if params are empty */
        $aVerifyResult = $this->oAuthService->checkIfParamsAreEmpty($sUsername, $sPassword);

        if($aVerifyResult[AppConstants::B_RESULT] === false) {
            $aFinalResult = $aVerifyResult;
        } else {
            /** 2nd Validation Process: Check if the account username exist */
            $aVerifyResult = $this->oAuthService->checkIfAccountExist($sUsername);
            if ($aVerifyResult[AppConstants::B_RESULT] === false) {
                $aFinalResult = $aVerifyResult;
            } else {
                /** 1st Verification Process: Check if the passwords matched */
                $aVerifyResult = data_get($aVerifyResult, AppConstants::DATA);
                $sDBRetrievedPassword = data_get($aVerifyResult, 'acc_password', '');
                if ($sPassword !== $sDBRetrievedPassword) {
                    $aFinalResult = [
                        AppConstants::CODE     => 200,
                        AppConstants::B_RESULT => false,
                        AppConstants::MESSAGE  => 'Password is Invalid'
                    ];
                } else {
                    /** 2nd Verification Process: Check if the account is deactivated */
                    $iDBRetrievedUserStatus = data_get($aVerifyResult, 'acc_status', 1);
                    if ($iDBRetrievedUserStatus === 3) {
                        $aFinalResult[AppConstants::CODE] = 200;
                        $aFinalResult[AppConstants::B_RESULT] = false;
                        $aFinalResult[AppConstants::MESSAGE] = "Your Account is Deactivated. \n Please Contact the Administrator to Re-activate your Account";
                    } else {
                        /** Initiate user session and set user status to online */
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

    /**
     * Retrieves the current user's session
     *
     * @return array
     */
    public function getSession()
    {
        return AuthLib::getUserSession();
    }

    /**
     * Destroy the user's current and session and logs out
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->oAuthService->setAccStatusToOffline();
        AuthLib::deleteUserSession();

        return Redirect::to('/');
    }
}
