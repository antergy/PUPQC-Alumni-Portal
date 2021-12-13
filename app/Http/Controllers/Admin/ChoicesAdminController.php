<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Services\Admin\ChoicesManagementService;
use App\Http\Controllers\Controller;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class ChoicesAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class ChoicesAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var ChoicesManagementService
     */
    public $oChoicesAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param ChoicesManagementService $oChoicesAdminService
     */
    public function __construct(Request $oRequest, ChoicesManagementService $oChoicesAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oChoicesAdminService = $oChoicesAdminService;
        LogLib::initTraceId('choices_manage');
    }

    /**
     * Retrieves Choices
     *
     * @return array
     */
    public function readChoices()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oChoicesAdminService->getChoices($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a Choice record
     *
     * @return array
     */
    public function createChoice()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();
            $aChoices = explode(',', $aParams['fqc_desc']);
            foreach ($aChoices as $sChoice) {
                /** Executes the request */
                $aParams = [
                    'fqc_fq_id' => $aParams['fqc_fq_id'],
                    'fqc_desc'  => $sChoice,
                ];
                $mResult = $this->oChoicesAdminService->createChoice($aParams);
            }

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], 'Successfully created choices');
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a Choice record
     *
     * @return array
     */
    public function updateChoice()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oChoicesAdminService->updateChoice($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Delete a Choice record
     *
     * @return array
     */
    public function deleteChoice()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oChoicesAdminService->deleteChoice($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update choices by question
     * - Delete choices by questions and recreate records
     *
     * @return array
     */
    public function updateChoicesByQuestion()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $iQuestionId = $aParams['fqc_fq_id'];
            $mResult = $this->oChoicesAdminService->deleteChoiceByQuestion(['fqc_fq_id' => $iQuestionId]);
            $aChoices = explode(',', $aParams['fqc_desc']);
            foreach ($aChoices as $sChoice) {
                /** Executes the request */
                $aParams = [
                    'fqc_fq_id' => $iQuestionId,
                    'fqc_desc'  => $sChoice,
                ];
                $mResult = $this->oChoicesAdminService->createChoice($aParams);
            }

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], 'Successfully updated question choices');
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
