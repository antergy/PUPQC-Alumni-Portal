<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\QuestionAnswerValidator;

/**
 * Class QuestionAnswerManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionAnswerManagementService extends CoreAdminService
{
    /**
     * Constant for Question Answers API Module
     */
    const QUESTION_ANSWER_API_MODULE = 'form/questions/answers';

    /**
     * Retrieves Question Answers record
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getAnswers(array $aParams)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::QUESTION_ANSWER_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Creates a Answer record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createAnswer(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionAnswerValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::QUESTION_ANSWER_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a Answer record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateAnswer(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = QuestionAnswerValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::QUESTION_ANSWER_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Delete an Answer record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deleteAnswer(array $aParams)
    {
        $sApiRoute = sprintf('/v1/%s/delete', self::QUESTION_ANSWER_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }
}
