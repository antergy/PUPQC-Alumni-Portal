<?php


namespace App\Http\Controllers\API\Form_Management;

use App\Core\API\CoreApiController;
use App\Http\Repositories\Form_Management\QuestionRepository;
use App\Http\Rules\API\Form_Management\QuestionRules;
use App\Libraries\API\ArrayLib;
use App\Libraries\API\WhereLib;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class QuestionApiController
 *
 * @package App\Http\Controllers\API\Form_Management
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   05/12/2021
 * @version 1.0
 */
class QuestionApiController extends CoreApiController
{
    /**
     * QuestionApiController constructor.
     *
     * @param Request $oRequest
     * @param QuestionRepository $oFormRepository
     */
    public function __construct(Request $oRequest, QuestionRepository $oFormRepository)
    {
        $this->oRequest = $oRequest;
        LogLib::$sTraceId = $this->oRequest->input(LogLib::TRACE_ID, LogLib::DEFAULT_TRACE_ID);
        $this->oRepository = $oFormRepository;
    }

    /**
     * Retrieves question record(s)
     *
     * @return array
     */
    public function getAll()
    {
        try {
            /** Initialize foreign key constraint */
            $this->oRepository->joinFormQuestionGroupTable('left');
            $this->oRepository->joinFormQuestionTypeTable('left');

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
     * Creates a question record
     *
     * @param QuestionRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function create(QuestionRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aQuestionCreate);
            $aData = ArrayLib::filterKeys($aRequest, $this->oRepository->aSearch);
            $aResponse = $this->oRepository->createRecord($aData);

            return ResponseLib::formatSuccessResponse($aResponse, ResponseLib::SUCCESS_CREATE_MESSAGE);
        } catch (QueryException | ValidationException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }

    /**
     * Updates a question record
     *
     * @param QuestionRules $oRules
     * @return array
     * @throws QueryException|ValidationException
     */
    public function update(QuestionRules $oRules)
    {
        try {
            $aRequest = $this->validate($this->oRequest, $oRules->aQuestionUpdate);
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
     * Deletes a question record
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
     * Enable/Disable a question record
     *
     * @return array
     */
    public function switchUpdate()
    {
        try {
            $iId = $this->oRequest->input($this->oRepository->sPrimaryKey);
            $iStatus = $this->oRequest->input('fq_active_status');
            $mResponse = $this->oRepository->updateRecord($iId, ['fq_active_status' => $iStatus]);
            $sMessage = $iStatus === 1 ? ResponseLib::SUCCESS_ENABLE_MESSAGE : ResponseLib::SUCCESS_DISABLE_MESSAGE;

            return ResponseLib::formatSuccessResponse($mResponse, $sMessage);
        } catch (QueryException $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }
    }
}
