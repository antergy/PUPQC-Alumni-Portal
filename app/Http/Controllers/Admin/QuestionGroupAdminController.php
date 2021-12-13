<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\QuestionGroupManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class QuestionGroupAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class QuestionGroupAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var QuestionGroupManagementService
     */
    public $oQuestionGroupAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param QuestionGroupManagementService $oQuestionGroupAdminService
     */
    public function __construct(Request $oRequest, QuestionGroupManagementService $oQuestionGroupAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oQuestionGroupAdminService = $oQuestionGroupAdminService;
        LogLib::initTraceId('question_group_manage');
    }

    /**
     * Retrieves Question Groups
     *
     * @return array
     */
    public function readQuestionGroups()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oQuestionGroupAdminService->getQuestionGroups($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a Question Group record
     *
     * @return array
     */
    public function createQuestionGroup()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionGroupAdminService->createQuestionGroup($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a Question Group record
     *
     * @return array
     */
    public function updateQuestionGroup()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionGroupAdminService->updateQuestionGroup($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Delete a Question Group record
     *
     * @return array
     */
    public function deleteQuestionGroup()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionGroupAdminService->deleteQuestionGroup($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Enable / Disable a Question Group record
     *
     * @return array
     */
    public function switchUpdateQuestionGroup()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oQuestionGroupAdminService->switchUpdateQuestionGroup($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
