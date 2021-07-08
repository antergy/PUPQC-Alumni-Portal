<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Services\Admin\QuestionManagementService;
use App\Http\Controllers\Controller;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class QuestionAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var QuestionManagementService
     */
    public $oQuestionAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param QuestionManagementService $oQuestionAdminService
     */
    public function __construct(Request $oRequest, QuestionManagementService $oQuestionAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oQuestionAdminService = $oQuestionAdminService;
        LogLib::initTraceId('question_manage');
    }

    /**
     * Retrieves Questions
     *
     * @return array
     */
    public function readQuestions()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oQuestionAdminService->getQuestions($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a Question record
     *
     * @return array
     */
    public function createQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionAdminService->createQuestion($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a Question record
     *
     * @return array
     */
    public function updateQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionAdminService->updateQuestion($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Delete a Question record
     *
     * @return array
     */
    public function deleteQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionAdminService->deleteQuestion($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
