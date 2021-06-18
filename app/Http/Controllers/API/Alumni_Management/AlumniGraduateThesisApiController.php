<?php

namespace App\Http\Controllers\API\Alumni_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Alumni_Management\AlumniGraduateThesisRepository;
use App\Http\Rules\API\Alumni_Management\AlumniRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class AlumniGraduateThesisApiController
 * @package App\Http\Controllers\API\Alumni_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/25/2021
 * @version 1.0
 */
class AlumniGraduateThesisApiController extends CoreApiController
{
    /**
     * AlumniGraduateThesisApiController constructor.
     * @param Request $oRequest
     * @param AlumniGraduateThesisRepository $oAlumniGraduateThesisRepository
     */
    public function __construct(Request $oRequest, AlumniGraduateThesisRepository $oAlumniGraduateThesisRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oAlumniGraduateThesisRepository;
    }

    /**
     * Retrieves alumni graduate thesis record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinAlumniTable('left');

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
     * Creates an alumni graduate thesis record
     *
     * @param AlumniRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(AlumniRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlumniGraduateThesisCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aData = $this->oRepository->encryptValues($aData, $this->oRepository->aEncryptedKeys);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates an alumni graduate thesis record
     *
     * @param AlumniRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(AlumniRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aAlumniGraduateThesisUpdate);
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
     * Deletes an alumni graduate thesis record
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
