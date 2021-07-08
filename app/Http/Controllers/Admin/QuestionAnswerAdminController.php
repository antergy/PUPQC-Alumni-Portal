<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Services\Admin\QuestionAnswerManagementService;
use App\Http\Controllers\Controller;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class QuestionAnswerAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionAnswerAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var QuestionAnswerManagementService
     */
    public $oAnswerAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param QuestionAnswerManagementService $oAnswerAdminService
     */
    public function __construct(Request $oRequest, QuestionAnswerManagementService $oAnswerAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oAnswerAdminService = $oAnswerAdminService;
        LogLib::initTraceId('question_answers_manage');
    }

    /**
     * Retrieves Question Answers
     *
     * @return array
     */
    public function readQuestions()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oAnswerAdminService->getAnswers($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a Question Answer record
     *
     * @return array
     */
    public function createQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oAnswerAdminService->createAnswer($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a Question Answer record
     *
     * @return array
     */
    public function updateQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oAnswerAdminService->updateAnswer($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Delete a Question Answer record
     *
     * @return array
     */
    public function deleteQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oAnswerAdminService->deleteAnswer($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
