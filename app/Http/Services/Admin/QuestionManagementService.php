<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\QuestionValidator;

/**
 * Class QuestionManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionManagementService extends CoreAdminService
{
    /**
     * Constant for Questions API Module
     */
    const QUESTION_API_MODULE = 'form/questions';

    /**
     * Retrieves Questions record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getQuestions(array $aParams)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::QUESTION_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a Question record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createQuestion(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::QUESTION_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a Question record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateQuestion(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::QUESTION_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Delete a Question record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteQuestion(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::QUESTION_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Enable / Disable a form record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function switchUpdateQuestion(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/switch', self::API_VERSION, self::QUESTION_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
