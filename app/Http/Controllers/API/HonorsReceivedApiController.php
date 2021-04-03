<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\HonorsReceivedRepository;
use App\Http\Rules\API\HonorsReceivedRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class HonorsReceivedApiController
 * @package App\Http\Controllers\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class HonorsReceivedApiController extends CoreApiController
{
    /**
     * HonorsReceivedApiController constructor.
     * @param Request $oRequest
     * @param HonorsReceivedRepository $HonorsRecRepository
     */
    public function __construct(Request $oRequest, HonorsReceivedRepository $HonorsRecRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $HonorsRecRepository;
    }

    /**
     * Retrieves honors received record(s)
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
     * Creates a honors received record
     *
     * @param HonorsReceivedRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(HonorsReceivedRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aHonorsReceivedCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a honors received record
     *
     * @param HonorsReceivedRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(HonorsReceivedRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aHonorsReceivedCreate);
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->updateRecord($iId, $aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_UPDATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes a honors received record
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
