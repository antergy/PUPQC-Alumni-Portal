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

    public function createAlumni()
    {

    }

    public function updateAlumni()
    {

    }

    public function deleteAlumni()
    {

    }
}
