<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\QuestionTypeValidator;

/**
 * Class QuestionTypeManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionTypeManagementService extends CoreAdminService
{
    /**
     * Constant for Question Type API Module
     */
    const QUESTION_TYPE_API_MODULE = 'form/questions/type';

    /**
     * Retrieves Question Types record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getQuestionTypes(array $aParams)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::QUESTION_TYPE_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a Question Type record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createQuestionType(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionTypeValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::QUESTION_TYPE_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a Question Type record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateQuestionType(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionTypeValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::QUESTION_TYPE_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Delete a Question Type record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteQuestionType(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::QUESTION_TYPE_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Switch Updated a Question Type record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function switchUpdateQuestionType(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/switch', self::QUESTION_TYPE_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
