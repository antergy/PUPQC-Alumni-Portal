<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\InboxRepository;
use App\Http\Rules\API\InboxRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class InboxesApiController
 * @package App\Http\Controllers\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/19/2021
 * @version 1.0
 */
class InboxesApiController extends CoreApiController
{
    /**
     * InboxesApiController constructor.
     * @param Request $oRequest
     * @param InboxRepository $oInboxRepository
     */
    public function __construct(Request $oRequest, InboxRepository $oInboxRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oInboxRepository;
    }

    /**
     * Retrieves inbox record(s)
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
            $aDecryptedResponse = $this->oRepository->decryptValues((json_decode(json_encode($aResponse), true)), $this->oRepository->aEncryptedKeys);

            return ResponseLib::formatSuccessResponse($aDecryptedResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a inbox record
     *
     * @param InboxRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(InboxRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aMessageCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes a inbox record
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

    /**
     * Changes the read status of the inbox (Update)
     * @return array
     */
    public function changeReadStatus()
    {
        try {
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $iStatus = $this->oRequest->input('in_is_read');
            $mResponse = $this->oRepository->updateRecord($iId, ['in_is_read' => $iStatus]);;

            return ResponseLib::formatSuccessResponse($mResponse, 'Successfully changed the status');
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
