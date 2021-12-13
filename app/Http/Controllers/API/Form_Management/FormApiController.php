<?php

namespace App\Http\Controllers\API\Form_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Form_Management\FormRepository;
use App\Http\Rules\API\Form_Management\FormRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class FormApiController
 *
 * @package App\Http\Controllers\API\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   04/23/2021
 * @version 1.0
 */
class FormApiController extends CoreApiController
{
    /**
     * FormApiController constructor.
     *
     * @param Request $oRequest
     * @param FormRepository $oFormRepository
     */
    public function __construct(Request $oRequest, FormRepository $oFormRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oFormRepository;
    }

    /**
     * Retrieves form record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinCourseTable('left');
            $this->oRepository->joinDegreeTable('left');

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

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_RETRIEVE_MESSAGE);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Creates a form record
     *
     * @param FormRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(FormRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aFormCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a form record
     *
     * @param FormRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(FormRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aFormUpdate);
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
     * Deletes a form record
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
     * Enable/Disable a form record
     *
     * @return array
     */
    public function switchUpdate()
    {
        try {
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $iStatus = $this->oRequest->input('form_active_status');
            $mResponse = $this->oRepository->updateRecord($iId, ['form_active_status' => $iStatus]);
            $sMessage = $iStatus === 1 ? ResponseLib::SUCCESS_ENABLE_MESSAGE : ResponseLib::SUCCESS_DISABLE_MESSAGE;

            return ResponseLib::formatSuccessResponse($mResponse, $sMessage);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}

