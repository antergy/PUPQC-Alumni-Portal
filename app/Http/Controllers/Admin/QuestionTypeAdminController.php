<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\QuestionTypeManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class QuestionTypeAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionTypeAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var QuestionTypeManagementService
     */
    public $oQuestionTypeAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param QuestionTypeManagementService $oQuestionTypeAdminService
     */
    public function __construct(Request $oRequest, QuestionTypeManagementService $oQuestionTypeAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oQuestionTypeAdminService = $oQuestionTypeAdminService;
        LogLib::initTraceId('question_type_manage');
    }

    /**
     * Retrieves Question Types
     *
     * @return array
     */
    public function readQuestionTypes()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oQuestionTypeAdminService->getQuestionTypes($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a Question Type record
     *
     * @return array
     */
    public function createQuestionType()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionTypeAdminService->createQuestionType($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a Question Type record
     *
     * @return array
     */
    public function updateQuestionType()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionTypeAdminService->updateQuestionType($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Delete a Question Type record
     *
     * @return array
     */
    public function deleteQuestionType()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionTypeAdminService->deleteQuestionType($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
