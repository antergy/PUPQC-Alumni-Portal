<?php

namespace App\Http\Services\Front;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Services\Admin\AccountManagementService;
use App\Libraries\Common\AuthLib;
use App\Libraries\Common\SessionLib;

/**
 * Class AuthService
 * @package App\Http\Services\Front
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   03/15/2021
 * @version 1.0
 */
class AuthService extends CoreAdminService
{
    /**
     * Check if the parameters are empty
     *
     * @param string $sUsername
     * @param string $sPassword
     * @return array
     */
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

    /**
     * Check if the account username exist
     *
     * @param string $sUsername
     * @return array
     */
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

    /**
     * Check if the account email exist
     *
     * @param string $sEmail
     * @return array
     */
    public function checkIfAccountExistByEmail($sEmail)
    {
        $bResult = true;
        $oAccMgtService = new AccountManagementService();
        $aParams = [
            'acc_email'     => $sEmail,
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

    /**
     * Removes sensitive info from the returning user details array
     * - Can be modified
     *
     * @param array $aAccountInfo
     * @return mixed
     */
    public function removeSensitiveInfo($aAccountInfo)
    {
        unset($aAccountInfo['acc_password']);

        return $aAccountInfo;
    }

    /**
     * Sets user account status to online
     */
    public function setAccStatusToOnline()
    {
        $this->setAccountStatus(1);
    }

    /**
     * Sets user account status to offline
     */
    public function setAccStatusToOffline()
    {
        $this->setAccountStatus(2);
    }

    /**
     * Sets account status
     *
     * @param int $iStatus
     */
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
