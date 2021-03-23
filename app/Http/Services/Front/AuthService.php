<?php

namespace App\Http\Services\Front;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Services\Admin\AccountManagementService;
use App\Libraries\Common\AuthLib;
use App\Libraries\Common\SessionLib;

class AuthService extends CoreAdminService
{
    public function checkIfParamsAreEmpty($sUsername, $sPassword)
    {
        $bResult = true;
        $sMessage = 'Username and Password are not empty';

        if  ($sUsername === '' || $sUsername === null) {
            $bResult = false;
            $sMessage = 'Username is empty';
        } else if ($sPassword === '' || $sPassword === null) {
            $bResult = false;
            $sMessage = 'Password is empty';
        } else if ($sUsername === '' ||  $sUsername === null && $sPassword === '' || $sPassword === null) {
            $bResult = false;
            $sMessage = 'Username and Password are empty';
        }

        return [
            AppConstants::B_RESULT => $bResult,
            AppConstants::MESSAGE  => $sMessage
        ];
    }

    public function checkIfAccountExist($sUsername)
    {
        $bResult = true;
        $oAccMgtService = new AccountManagementService();
        $aParams = [
            'acc_username'     => $sUsername,
            'password_visible' => 'true'
        ];
        $aResult = $oAccMgtService->getAccounts($aParams);
        $aResultData = data_get($aResult, AppConstants::DATA, []);
        $aResultMsg = data_get($aResult, AppConstants::MESSAGE, '');
        if (empty($aResultData) === true) {
            $bResult = false;
            $sMessage = "Account Doesn't Exists";
            $aData = [];
        } else {
            $sMessage = $aResultMsg;
            $aData = $aResultData[0];
        }

        return [
            AppConstants::B_RESULT => $bResult,
            AppConstants::MESSAGE  => $sMessage,
            AppConstants::DATA     => $aData
        ];
    }

    public function removeSensitiveInfo($aAccountInfo)
    {
        unset($aAccountInfo['acc_password']);

        return $aAccountInfo;
    }

    public function setAccStatusToOnline()
    {
        $this->setAccountStatus(1);
    }

    public function setAccStatusToOffline()
    {
        $this->setAccountStatus(2);
    }

    private function setAccountStatus($iStatus)
    {
        $iUid = SessionLib::getSession(AuthLib::USER_ID);
        $oAccMgtService = new AccountManagementService();
        $aParams = [
            'acc_id'     => $iUid,
            'acc_status' => $iStatus
        ];
        $oAccMgtService->updateAccount($aParams);
    }
}
