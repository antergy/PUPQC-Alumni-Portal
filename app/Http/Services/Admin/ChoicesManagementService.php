<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\ChoicesValidator;
use App\Libraries\API\ArrayLib;

/**
 * Class ChoicesManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class ChoicesManagementService extends CoreAdminService
{
    /**
     * Constant for Question Choices API Module
     */
    const QUESTION_CHOICES_API_MODULE = 'form/questions/choices';

    /**
     * Retrieves choices record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getChoices(array $aParams)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::QUESTION_CHOICES_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a choice record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createChoice(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = ChoicesValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::QUESTION_CHOICES_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a choice record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateChoice(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = ChoicesValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::QUESTION_CHOICES_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Delete a choice record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteChoice(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::QUESTION_CHOICES_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Delete a choices by question
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteChoiceByQuestion(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete_by_question', self::QUESTION_CHOICES_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
