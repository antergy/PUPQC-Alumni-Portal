<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\QuestionGroupValidator;

/**
 * Class QuestionGroupManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionGroupManagementService extends CoreAdminService
{
    /**
     * Constant for Question Group API Module
     */
    const QUESTION_GROUP_API_MODULE = 'form/questions/group';

    /**
     * Retrieves Question Groups record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getQuestionGroups(array $aParams)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::QUESTION_GROUP_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a Question Group record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createQuestionGroup(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionGroupValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::QUESTION_GROUP_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a Question Group record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateQuestionGroup(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionGroupValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::QUESTION_GROUP_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Enable/Disable a Question Group record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function switchUpdateQuestionGroup(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/switch', self::API_VERSION, self::QUESTION_GROUP_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Delete a Question Group record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteQuestionGroup(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::QUESTION_GROUP_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
