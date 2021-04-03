<?php

namespace App\Http\Controllers\API\Alumni_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Alumni_Management\AlumniCompetencies;
use App\Http\Rules\API\Alumni_Management\AlumniCompetencyRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class AlumniCompetencyApiController
 * @package App\Http\Controllers\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/07/2021
 * @version 1.0
 */
class AlumniCompetencyApiController extends CoreApiController
{
    /**
     * AlumniJobLevelApiController constructor.
     * @param Request $oRequest
     * @param AlumniCompetencies $oAlumniCompetenciesRepository
     */
    public function __construct(Request $oRequest, AlumniCompetencies $oAlumniCompetenciesRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oAlumniCompetenciesRepository;
    }

    /**
     * Retrieves alumni competency record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAlumniTable('inner');
            $this->oRepository->joinCompetencyTable('left');

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
     * Creates an alumni competency record
     *
     * @param AlumniCompetencyRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(AlumniCompetencyRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlCompetencyCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes an alumni competency record by alumni
     *
     * @return array
     */
    public function bulkDelete()
    {
        try {
            $sReferenceColumn = 'alcom_alumni_id';
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
