<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\FormManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class FormAdminController
 * @package App\Http\Controllers\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class FormAdminController extends Controller
{
    /**
 * Holds the instance of Illuminate\Http\Request
 * @var Request
 */
    public $oRequest;

    /**
     * Holds the instance of account management service
     * @var FormManagementService
     */
    public $oFormAdminService;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     * @param FormManagementService $oFormAdminService
     */
    public function __construct(Request $oRequest, FormManagementService $oFormAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oFormAdminService = $oFormAdminService;
        LogLib::initTraceId('form_manage');
    }

    /**
     * Retrieves forms
     *
     * @return array
     */
    public function readForms()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oFormAdminService->getForms($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieves only the forms
     *
     * @return array
     */
    public function readFormOnly()
    {
        try {
            /** Prepare the parameters */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oFormAdminService->getFormOnly($aParams);
            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create a form record
     *
     * @return array
     */
    public function createForm()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oFormAdminService->createForm($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Update a form record
     *
     * @return array
     */
    public function updateForm()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oFormAdminService->updateForm($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deactivate a form record
     *
     * @return array
     */
    public function deleteForm()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oFormAdminService->deactivateForm($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Enable / Disable a form record
     *
     * @return array
     */
    public function switchUpdateForm()
    {
        try {
            /** Prepares the parameters */
            $aParams = $this->oRequest->all();

            /** Executes the request */
            $mResult = $this->oFormAdminService->switchUpdateForm($aParams);

            return ResponseLib::formatSuccessResponse($mResult[AppConstants::DATA], $mResult[AppConstants::MESSAGE]);
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
