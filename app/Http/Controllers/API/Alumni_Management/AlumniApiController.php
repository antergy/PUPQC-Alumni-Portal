<?php

namespace App\Http\Controllers\API\Alumni_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Alumni_Management\Alumni;
use App\Http\Rules\API\Alumni_Management\AlumniRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class AlumniApiController
 * @package App\Http\Controllers\API\Alumni_Management
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/03/2021
 * @version 1.0
 */
class AlumniApiController extends CoreApiController
{
    /**
     * AlumniApiController constructor.
     * @param Request $oRequest
     * @param Alumni $oAlumniRepository
     */
    public function __construct(Request $oRequest, Alumni $oAlumniRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oAlumniRepository;
    }

    /**
     * Retrieves alumni record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAccountsTable('left');
            $this->oRepository->joinCourseTable('left');
            $this->oRepository->joinEducAttainTable('left');
            $this->oRepository->joinHonorsReceivedTable('left');
            $this->oRepository->joinProfExamTable('left');
            $this->oRepository->joinFirstJobDiscoverTable('left');
            $this->oRepository->joinFirstJobTimeFrameTable('left');
            $this->oRepository->joinSelfEmploySalaryTable('left');

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

            /** Decrypt encrypted values */
            $aDecryptedResponse = $this->oRepository->decryptValues((json_decode(json_encode($aResponse), true)), $this->oRepository->aEncryptedKeys);

            return ResponseLib::formatSuccessResponse($aDecryptedResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates an alumni record
     *
     * @param AlumniRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(AlumniRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlumniCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates an alumni record
     *
     * @param AlumniRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(AlumniRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlumniUpdate);
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
     * Deletes an alumni record
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
