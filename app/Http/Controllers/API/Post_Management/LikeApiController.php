<?php

namespace App\Http\Controllers\API\Post_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Post_Management\LikeRepository;
use App\Http\Rules\API\Post_Management\LikeRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class LikeApiController
 * @package App\Http\Controllers\API\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class LikeApiController extends CoreApiController
{
    /**
     * LikeApiController constructor.
     * @param Request $oRequest
     * @param LikeRepository $oLikeRepository
     */
    public function __construct(Request $oRequest, LikeRepository $oLikeRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oLikeRepository;
    }

    /**
     * Initializes the repository
     *
     * @return array
     */
    private function initRepository()
    {
        /** Initialize foreign key constraint */
        $this->oRepository->joinPostTable();
        $this->oRepository->joinAccountTable();

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

        return $aSelect;
    }

    /**
     * Retrieves the like record count only
     *
     * @return array
     */
    public function getCount()
    {
        try {
            /** initialize repository */
            $this->initRepository();
            /** Execute get query */
            $aResponse = $this->oRepository->getCount();

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Retrieves like record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** initialize repository */
            $aSelect = $this->initRepository();
            /** Execute get query */
            $aResponse = $this->oRepository->getAll($aSelect);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a like record
     *
     * @param LikeRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(LikeRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aLikeCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a like record
     *
     * @param LikeRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(LikeRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aLikeUpdate);
            $iId = intval($this->oRequest->input($this->oRepository->sPrimaryKey));
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->updateRecord($iId, $aData);
            $sMessage = ResponseLib::SUCCESS_UPDATE_MESSAGE;
            if ($aResponse === 0) {
                $sMessage = 'There is nothing to update';
            }
            return ResponseLib::formatSuccessResponse($aResponse, $sMessage);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes a like record
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
     * Deletes a like records by post
     *
     * @return array
     */
    public function bulkDelete()
    {
        try {
            $sReferenceColumn = 'lk_post_id';
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
