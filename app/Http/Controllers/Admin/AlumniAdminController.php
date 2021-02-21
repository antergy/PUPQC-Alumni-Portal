<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AlumniManagementService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Http\Request;

/**
 * Class AlumniAdminController
 * @package App\Http\Controllers\Admin
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/07/2021
 * @version 1.0
 */
class AlumniAdminController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    /**
     * Holds the instance of alumni management service
     * @var AlumniManagementService
     */
    public $oAlumniAdminService;

    /**
     * AlumniAdminController constructor.
     * @param Request $oRequest
     * @param AlumniManagementService $oAlumniAdminService
     */
    public function __construct(Request $oRequest, AlumniManagementService $oAlumniAdminService)
    {
        $this->oRequest = $oRequest;
        $this->oAlumniAdminService = $oAlumniAdminService;
        LogLib::initTraceId('alumni');
    }

    /**
     * Retrieve alumni list
     *
     * @return array
     */
    public function getAllAlumni()
    {
        try {
            /** Prepare the parameters, request route and method to be used */
            $aParams = $this->oRequest->all();

            /** Execute request */
            $mResult = $this->oAlumniAdminService->listAlumni($aParams);
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieve alumni details
     * - Includes work experience, unemployment reason, and shared contacts
     *
     * @return array
     */
    public function getAlumniDetails()
    {
        try {
            /** Prepare the parameters, request route and method to be used */
            $iAlumniId = $this->oAlumniAdminService->getAlumniId($this->oRequest);
            if ($iAlumniId === false) {
                return ResponseLib::formatSuccessResponse(false, 'Alumni id is required');
            }

            /** Execute request */
            $mResult = $this->oAlumniAdminService->getAlumniDetails($iAlumniId);
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieve alumni reflection details
     * - Includes competencies and impact of education
     *
     * @return array
     */
    public function getAlumniReflectionDetails()
    {
        try {
            /** Prepare the parameters, request route and method to be used */
            $iAlumniId = $this->oAlumniAdminService->getAlumniId($this->oRequest);
            if ($iAlumniId === false) {
                return ResponseLib::formatSuccessResponse(false, 'Alumni id is required');
            }

            /** Execute request */
            $mResult = $this->oAlumniAdminService->getAlumniReflectionDetails($iAlumniId);
            return ResponseLib::formatSuccessResponse($mResult['data'], $mResult['message']);
        } catch (\Throwable $oException) {

            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Create an alumni record
     */
    public function createAlumni()
    {
        // @TODO (Insert Code Here)
    }

    /**
     * Update an alumni record
     */
    public function updateAlumni()
    {
        // @TODO (Insert Code Here)
    }

    /**
     * Delete an alumni
     */
    public function deleteAlumni()
    {
        // @TODO (Insert Code Here)
    }
}
