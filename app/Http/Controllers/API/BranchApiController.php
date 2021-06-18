<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\BranchRepository;
use App\Http\Rules\API\BranchRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class BranchApiController
 * @package App\Http\Controllers\API
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/28/2021
 * @version 1.0
 */
class BranchApiController extends CoreApiController
{
    /**
     * BranchApiController constructor.
     * @param Request $oRequest
     * @param BranchRepository $oBranchRepository
     */
    public function __construct(Request $oRequest, BranchRepository $oBranchRepository)
    {

        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oBranchRepository;
    }

    /**
     * Retrieves branch record(s)
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
            array_unshift($aSelect, $this->oRepository->sPrimaryKey);
            $aResponse = $this->oRepository->getAll($aSelect);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a branch record
     *
     * @param BranchRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(BranchRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aBranchCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a branch record
     *
     * @param BranchRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(BranchRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aBranchUpdate);
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->updateRecord($iId, $aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_UPDATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes a branch record
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
