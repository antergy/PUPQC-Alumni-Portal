<?php

namespace App\Http\Controllers\API\Alumni_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Alumni_Management\AlumniImpactEducation;
use App\Http\Rules\API\Alumni_Management\AlumniImpactEducRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class AlumniImpactEducationApiController
 * @package App\Http\Controllers\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/04/2021
 * @version 1.0
 */
class AlumniImpactEducationApiController extends CoreApiController
{
    /**
     * AlumniImpactEducationApiController constructor.
     * @param Request $oRequest
     * @param AlumniImpactEducation $oAlumniImpactEducationRepository
     */
    public function __construct(Request $oRequest, AlumniImpactEducation $oAlumniImpactEducationRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oAlumniImpactEducationRepository;
    }

    /**
     * Retrieves alumni impact of education record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAlumniTable('left');
            $this->oRepository->joinImpactEducationTable('left');

            /** Initialize where clause from default table */
            $aSearch = $this->oRepository->aSearch;
            $aMainWhere = $this->oRequest->only($aSearch);

            /** $Included fields from reference table to the where clause */
            $aForeignSearch = array_keys($this->oRepository->aForeignColumns);
            $aForeignWhere = $this->oRequest->only($aForeignSearch);
            $aWhere = array_merge($aMainWhere, $aForeignWhere);

            /** Arrange where clause values */
            $aWhere = WhereLib::makeArray($aWhere);
            $this->oRepository->searchParams($aWhere);

            $aSelect = array_merge($aForeignSearch, $aSearch);
            array_unshift($aSelect, $this->oRepository->sPrimaryKey);

            /** Execute get query */
            $aResponse = $this->oRepository->getAll($aSelect);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates an alumni impact of education record
     *
     * @param AlumniImpactEducRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(AlumniImpactEducRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlImpactEducCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes an alumni impact of education record by alumni
     *
     * @return array
     */
    public function bulkDelete()
    {
        try {
            $sReferenceColumn = 'aled_alumni_id';
            $iReferenceId = $this->oRequest->input($sReferenceColumn);
            $mResponse = $this->oRepository->bulkDelete($sReferenceColumn, $iReferenceId);
            $sMessage = ResponseLib::SUCCESS_DELETE_MESSAGE;
            if ($mResponse === 0) {
                $sMessage = ResponseLib::NO_RECORD_DELETE_MESSAGE;
            }
            return ResponseLib::formatSuccessResponse($mResponse, $sMessage);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
