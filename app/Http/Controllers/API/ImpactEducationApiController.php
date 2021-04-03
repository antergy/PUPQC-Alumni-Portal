<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\ImpactEducationRepository;
use App\Http\Rules\API\ImpactEducationRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ImpactEducationApiController
 * @package App\Http\Controllers\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class ImpactEducationApiController extends CoreApiController
{
    /**
    * ImpactEducationApiController constructor.
    * @param Request $oRequest
    * @param ImpactEducationRepository $oImpactEducationRepository
    */
    public function __construct(Request $oRequest, ImpactEducationRepository $oImpactEducationRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oImpactEducationRepository;
    }

    /**
     * Retrieves impact of education record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            $aSearch = $this->oRepository->aSearch;
            $aMainWhere = $this->oRequest->only($aSearch);
            $aWhere = WhereLib::makeArray($aMainWhere);
            $this->oRepository->searchParams($aWhere);
            $aSelect = $aSearch;
            array_unshift($aSearch, $this->oRepository->sPrimaryKey);
            $aResponse = $this->oRepository->getAll($aSelect);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates an impact of education record
     *
     * @param ImpactEducationRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(ImpactEducationRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aImpactEducationCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates an impact of education record
     *
     * @param ImpactEducationRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(ImpactEducationRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aImpactEducationCreate);
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->updateRecord($iId, $aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_UPDATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes an impact of education record
     *
     * @return array
     */
    public function delete()
    {
        try {
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $mResponse = $this->oRepository->deleteRecord($iId);
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
