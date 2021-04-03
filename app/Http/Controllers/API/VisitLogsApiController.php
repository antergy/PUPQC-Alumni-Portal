<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\VisitLogsRepository;
use App\Http\Rules\API\VisitLogsRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class VisitLogsApiController
 * @package App\Http\Controllers\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/15/2021
 * @version 1.0
 */
class VisitLogsApiController extends CoreApiController
{
    /**
     * VisitLogsApiController constructor.
     * @param Request $oRequest
     * @param VisitLogsRepository $oVisitLogsRepository
     */
    public function __construct(Request $oRequest, VisitLogsRepository $oVisitLogsRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oVisitLogsRepository;
    }

    /**
     * Retrieves visit logs record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAccountTable();

            /** Initialize where clause from default table */
            $aSearch = $this->oRepository->aSearch;
            $aMainWhere = $this->oRequest->only($aSearch);
            $aWhereDates = $this->oRequest->only(['start_date', 'end_date']);

            /** $Included fields from reference table to the where clause */
            $aForeignSearch = array_keys($this->oRepository->aForeignColumns);
            $aForeignWhere = $this->oRequest->only($aForeignSearch);
            $aWhere = array_merge($aMainWhere, $aForeignWhere);

            /** Arrange where clause values */
            $aWhere = WhereLib::makeArray($aWhere);
            $this->oRepository->searchParams($aWhere);

            /** If there is a given date range */
            if (!empty($aWhereDates) === true) {
                $this->oRepository->whereDateBetween($this->oRepository->sTableName, $aWhereDates, $this->oRepository->sCreatedDateColumn);
            }
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
     * Creates a visit log record
     *
     * @param VisitLogsRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(VisitLogsRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aVisitLogsCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
