<?php

namespace App\Http\Services\Admin;

use App\Core\Admin\CoreAdminService;

/**
 * Class VisitLogsManagementService
 * @package App\Http\Services\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/18/2021
 * @version 1.0
 */
class VisitLogsManagementService extends CoreAdminService
{
    /**
     * Constant for this service's api module
     */
    const API_MODULE = 'visit_logs';

    /**
     * Constant for visit account id field name
     */
    const VISIT_ACC_ID = 'vs_acc_id';

    /**
     * Retrieves log records
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function readLogs($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/read', self::API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates log record
     *
     * @param int $iAccountId
     * @return array|mixed
     */
    public function createLog($iAccountId)
    {
        /** Initialize the account management service */
        $oAccountManageService = new AccountManagementService();

        /** Validate the account id */
        $aValidateResult = $oAccountManageService->validateAccountId($iAccountId);
        if ($aValidateResult['data'] === false) {
            return $aValidateResult;
        }

        /** Create log record if validation is successful */
        $aParams = [self::VISIT_ACC_ID => $iAccountId];
        $sApiRoute = sprintf('/v1/%s/create', self::API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
