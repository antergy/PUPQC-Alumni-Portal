<?php

namespace App\Http\Services\Admin;

use App\Core\Admin\CoreAdminService;
use App\Http\Validators\MessageValidator;

/**
 * Class InboxManagementService
 * @package App\Http\Services\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/20/2021
 * @version 1.0
 */
class InboxManagementService extends CoreAdminService
{
    /**
     * Constant for API Module
     */
    const API_MODULE = 'message';

    /**
     * Action divider depending on the request
     *
     * @param string $sAction
     * @param array $aParams
     * @return array|mixed|null
     */
    public function actionDivider($sAction, $aParams = [])
    {
        $mResult = null;
        if ($sAction === 'read') {
            /** Proceed to message(s) retrieval */
            $mResult = $this->getMessages($aParams);
        } else if ($sAction === 'create') {
            /** Proceed to message creation / update */
            $mResult = $this->createMessage($aParams);
        } else if ($sAction === 'delete') {
            /** Proceed to message deletion */
            $mResult = $this->deleteMessage($aParams);
        }

        return $mResult;
    }

    /**
     * Retrieve message(s)
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getMessages($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/read', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a message
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createMessage($aParams)
    {
        $aValidationResult = MessageValidator::validate($aParams);
        if ($aValidationResult['data'] === false) {
            $mResult = $aValidationResult;
        } else {
            $sApiRoute = sprintf('/v1/%s/create', self::API_MODULE);
            $mResult = $this->sendGuzzleRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Deletes a message
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function deleteMessage($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::API_MODULE);

        return $this->sendGuzzleRequest($sApiRoute, 'POST', $aParams);
    }
}
