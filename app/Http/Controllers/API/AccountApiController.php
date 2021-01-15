<?php

namespace App\Http\Controllers\API;

use App\Core\API\CoreApiController;
use App\Http\Repositories\AccountRepository;
use App\Http\Rules\API\AccountRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class AccountApiController
 * @package App\Http\Controllers\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/14/2021
 * @version 1.0
 */
class AccountApiController extends CoreApiController
{
    /**
     * AccountApiController constructor.
     * @param Request $oRequest
     * @param AccountRepository $oAccountRepository
     */
    public function __construct(Request $oRequest, AccountRepository $oAccountRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oAccountRepository;
    }

    /**
     * Retrieves account record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAccountTypesTable();

            /** Check if the password is requested to be visible */
            $sGetPassword = $this->oRequest->input('password_visible', 'false');
            if ($sGetPassword === 'true') {
                array_push($this->oRepository->aSearch, $this->oRepository->sPasswordField);
            }

            /** Initialize where clause from default table */
            $aSearch = $this->oRepository->aSearch;
            $aMainWhere = $this->oRequest->only($aSearch);
            $aMainWhere = $this->oRepository->encryptValues($aMainWhere, $this->oRepository->aEncryptedKeys);

            /** $Included fields from reference table to the where clause */
            $aForeignSearch = array_keys($this->oRepository->aForeignColumns);
            $aForeignWhere = $this->oRequest->only($aForeignSearch);
            $aWhere = array_merge($aMainWhere, $aForeignWhere);

            /** Check if there are fields to be searched by "LIKE" */
            $sSearchByLike = $this->oRequest->input('search_by_like', 'false');
            if ($sSearchByLike === 'true') {
                foreach ($this->oRepository->aFieldsLikeAllowed as $sField) {
                    if (array_key_exists($sField, $aWhere) === true) {
                        $aWhere["{$sField}-like"] = $aWhere[$sField];
                        $aWhere = array_replace($aWhere, ["{$sField}-like" => "%{$aWhere[$sField]}%"]);
                        unset($aWhere[$sField]);
                    }
                }
            }

            /** Arrange where clause values */
            $aWhere = WhereLib::makeArray($aWhere);
            $this->oRepository->searchParams($aWhere);
            $aSelect = array_merge($aForeignSearch, $aSearch);
            array_unshift($aSelect, $this->oRepository->sPrimaryKey);

            /** Execute get query */
            $aResponse = $this->oRepository->getAll($aSelect);

            /** Decrypt encrypted values */
            $aDecryptedResponse = $this->oRepository->decryptValues((json_decode(json_encode($aResponse), true)), $this->oRepository->aEncryptedKeys);

            return ResponseLib::formatSuccessResponse($aDecryptedResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates an account record
     *
     * @param AccountRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(AccountRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAccountCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates an account record
     *
     * @param AccountRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(AccountRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAccountUpdate);
            $iId = intval($this->oRequest->input($this->oRepository->sPrimaryKey));
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->updateRecord($iId, $aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_UPDATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Deletes an account record
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
