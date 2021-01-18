<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\AccountValidator;
use App\Libraries\API\ArrayLib;

/**
 * Class AccountManagementService
 * @package App\Http\Services\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 */
class AccountManagementService extends CoreAdminService
{
    /**
     * Constant for API Module
     */
    const API_MODULE = 'account';

    /**
     * Action divider depending on the request
     *
     * @param string $sAction
     * @param array $aParams
     * @return array
     */
    public function actionDivider($sAction, $aParams = [])
    {
        $mResult = null;
        if ($sAction === 'read') {
            /** Proceed to accounts details retrieval */
            $mResult = $this->getAccounts($aParams);
        } else if ($sAction === 'create' || $sAction === 'update') {
            /** Validate entered params */
            $aValidationResult = AccountValidator::validate($aParams);
            if ($aValidationResult['data'] === false) {
                return $aValidationResult;
            }

            /** Check if there are duplicate /existing values in the db based on the entered params */
            $aDuplicateResult = $this->checkDuplicateAccountDetails($aParams);
            if ($aDuplicateResult['data'] === false) {
                return $aDuplicateResult;
            } else {
                /** Proceed to account creation / update */
                $mResult = $sAction === 'create' ? $this->createAccount($aParams) : $this->updateAccount($aParams);
            }

        } else if ($sAction === 'deactivate') {
            /** Proceed to account deactivation */
            $mResult = $this->deactivateAccount($aParams);
        }

        return $mResult;
    }

    /**
     * Checks duplicate account details before create/update
     *
     * @param array $aParams
     * @return array
     */
    public function checkDuplicateAccountDetails($aParams)
    {
        /** Initialize true values */
        $mData = true;
        $sMessage = "There are no matching accounts with the said parameters";

        /** Defined prohibited to be duplicated fields and filter the parameters */
        $aProhibitedDuplicateFields = ['acc_username', 'acc_email'];
        $aFilteredParams = ArrayLib::filterKeys($aParams, $aProhibitedDuplicateFields);

        /** Check if there are duplicate details by each specified field */
        foreach($aFilteredParams as $aFilteredParam => $sValue) {
            $mInitialSearch = data_get($this->getAccounts([$aFilteredParam => $sValue]),AppConstants::DATA);

            /** Check if there are no duplicates */
            if (empty($mInitialSearch) === false) {
                /** Check if there is an existing username already in the db */
                if ($aFilteredParams['acc_username'] === $mInitialSearch['0']['acc_username']) {
                    $sMessage = 'Username already exists!';
                    $mData = false;

                    return [
                        AppConstants::DATA    => $mData,
                        AppConstants::MESSAGE => $sMessage
                    ];
                }
                /** Check if there is an existing/registered email already in the db */
                if ($aFilteredParams['acc_email'] === $mInitialSearch['0']['acc_email']) {
                    $sMessage = 'Email is already registered!';
                    $mData = false;
                }
            }
        }

        return [
            AppConstants::DATA    => $mData,
            AppConstants::MESSAGE => $sMessage
        ];
    }

    /**
     * Retrieves the account list and details
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getAccounts($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/read', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates an account
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function createAccount($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/create', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Updates the account specified
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function updateAccount($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/update', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Deactivates the account specified
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function deactivateAccount($aParams)
    {
        $aAllowedFields = ['acc_id'];
        $aAllowedParams = array_merge(['acc_status' => 3], ArrayLib::filterKeys($aParams, $aAllowedFields));
        $sApiRoute = sprintf('/v1/%s/update', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'POST', $aAllowedParams);
    }

    /**
     * Validates account id
     *
     * @param int $iAccountId
     * @return array
     */
    public function validateAccountId($iAccountId)
    {
        $bResult = true;
        $sMessage = "The account id is validated.";

        if ($iAccountId === '' || $iAccountId === null) {
            /** Check if the given account id is empty or null */
            $bResult = false;
            $sMessage = "There is no given account id.";
        } else if (is_numeric($iAccountId) === false) {
            /** Check if the given account id is a number */
            $bResult = false;
            $sMessage = "The given account id is invalid.";
        } else {
            /** Check if the given account exists in the database */
            $aParams = ['acc_id' => $iAccountId];
            $aResult = $this->getAccounts($aParams);
            if (empty($aResult['data']) === true) {
                $bResult = false;
                $sMessage = "The account doesn't exist.";
            }
        }

        return [
            'data'    => $bResult,
            'message' => $sMessage
        ];
    }
}
