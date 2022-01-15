<?php

namespace App\Http\Controllers\API\Post_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Post_Management\CommentRepository;
use App\Http\Rules\API\Post_Management\CommentRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class CommentApiController
 * @package App\Http\Controllers\API\Post_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/21/2021
 * @version 1.0
 */
class CommentApiController extends CoreApiController
{
    /**
     * CommentApiController constructor.
     * @param Request $oRequest
     * @param CommentRepository $oCommentRepository
     */
    public function __construct(Request $oRequest, CommentRepository $oCommentRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oCommentRepository;
    }

    /**
     * Initialize repository
     *
     * @return array
     */
    public function initRepository()
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
     * Retrieves the comments record count only
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
     * Retrieves comment record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize repository */
            $aSelect = $this->initRepository();
            /** Execute get query */
            $this->oRepository->orderBy('asc', 't_comments.created_at');
            $aResponse = $this->oRepository->getAll($aSelect);
            /** Decrypt encrypted values */
            $aDecryptedResponse = $this->oRepository->decryptValues((json_decode(json_encode($aResponse), true)), $this->oRepository->aEncryptedKeys);

            return ResponseLib::formatSuccessResponse($aDecryptedResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a comment record
     *
     * @param CommentRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(CommentRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aCommentCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a comment record
     *
     * @param CommentRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(CommentRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aCommentUpdate);
            $iId = intval($this->oRequest->input($this->oRepository->sPrimaryKey));
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
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
     * Deletes a comment record
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
     * Deletes a comment record by post
     *
     * @return array
     */
    public function bulkDelete()
    {
        try {
            $sReferenceColumn = 'cm_post_id';
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
