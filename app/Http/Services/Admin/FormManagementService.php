<?php


namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Http\Validators\FormValidator;
use App\Libraries\API\ArrayLib;

/**
 * Class FormManagementService
 * @package App\Http\Services\Admin
 * @author  Gerard O. Maglaque <maglaquegerard@gmail.com>
 * @since   07/05/2021
 * @version 1.0
 */
class FormManagementService extends CoreAdminService
{
    /**
     * Constant for Form API Module
     */
    const FORM_API_MODULE = 'form';

    /**
     * Constant for Questions API Module
     */
    const FORM_QUESTION_API_MODULE = 'questions';

    /**
     * Constant for Question Group API Module
     */
    const FORM_QUESTION_GROUP_API_MODULE = 'group';

    /**
     * Constant for Questions API Module
     */
    const FORM_QUESTION_TYPE_API_MODULE = 'type';

    /**
     * Constant for Questions API Module
     */
    const FORM_QUESTION_CHOICES_API_MODULE = 'choices';

    /**
     * Retrieves only the form records
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getFormOnly(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::FORM_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Retrieves form records
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function getForms(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/read', self::API_VERSION, self::FORM_API_MODULE);
        $aForms = $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);

        return $aForms;
    }

    /**
     * Retrieves form question group records
     *
     * @param int $iFormId
     * @return array|mixed
     */
    public function getFormQuestionGroups(int $iFormId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/form/questions/%s/read', self::API_VERSION, self::FORM_QUESTION_GROUP_API_MODULE);
        $aFormQuestionGroup = $this->sendInternalApiRequest($sApiRoute, 'GET', ['fqg_form_id' => $iFormId]);

        $mResult = [];
        foreach ($aFormQuestionGroup[AppConstants::DATA] as $aQuestionGroup) {
            $aQuestions = $this->getFormQuestions($aQuestionGroup['fqg_id']);
            $aQuestionGroupWithQuestions = array_merge($aQuestionGroup, ['questions' => $aQuestions]);
            array_push($mResult, $aQuestionGroupWithQuestions);
        }

        /** Replace the data value of the posts variable */
        $aFormQuestionGroup[AppConstants::DATA] = $mResult;

        return data_get($aFormQuestionGroup, AppConstants::DATA);
    }

    /**
     * Retrieves form questions record
     *
     * @param int $iQuestionGroupId
     * @return array|mixed
     */
    public function getFormQuestions(int $iQuestionGroupId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/form/%s/read', self::API_VERSION, self::FORM_QUESTION_API_MODULE);
        $aFormQuestions = $this->sendInternalApiRequest($sApiRoute, 'GET', ['fq_fqg_id' => $iQuestionGroupId]);

        $mQuestionTypeResult = [];
        foreach ($aFormQuestions[AppConstants::DATA] as $aQuestion) {
            $aQuestionType = $this->getFormQuestionType($aQuestion['fq_fqt_id']);
            $aQuestionWithQuestionType = array_merge($aQuestion, ['question_type' => $aQuestionType]);
            array_push($mQuestionTypeResult, $aQuestionWithQuestionType);
        }

        /** Replace the data value of the posts variable */
        $aFormQuestions[AppConstants::DATA] = $mQuestionTypeResult;

        $mChoicesResult = [];
        foreach ($aFormQuestions[AppConstants::DATA] as $aQuestion) {
            $aQuestionChoices = $this->getFormQuestionChoices($aQuestion['fq_id']);
            $aQuestionWithQuestionChoices = array_merge($aQuestion, ['question_choices' => $aQuestionChoices]);
            array_push($mChoicesResult, $aQuestionWithQuestionChoices);
        }

        /** Replace the data value of the posts variable */
        $aFormQuestions[AppConstants::DATA] = $mChoicesResult;

        return data_get($aFormQuestions, AppConstants::DATA);
    }

    /**
     * Retrieves form question type record
     *
     * @param int $iQuestionTypeId
     * @return array|mixed
     */
    public function getFormQuestionType(int $iQuestionTypeId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/form/questions/%s/read', self::API_VERSION, self::FORM_QUESTION_TYPE_API_MODULE);
        $mResult = $this->sendInternalApiRequest($sApiRoute, 'GET', ['fqt_id' => $iQuestionTypeId]);

        return data_get($mResult[AppConstants::DATA][0], 'fqt_desc');
    }

    /**
     * Retrieves form question choices record
     *
     * @param int $iQuestionId
     * @return array|mixed
     */
    public function getFormQuestionChoices(int $iQuestionId)
    {
        /** Build request url then executes it */
        $sApiRoute = sprintf('/%s/form/questions/%s/read', self::API_VERSION, self::FORM_QUESTION_CHOICES_API_MODULE);
        $mResult = $this->sendInternalApiRequest($sApiRoute, 'GET', ['fqc_fq_id' => $iQuestionId]);

        return data_get($mResult, AppConstants::DATA);
    }

    /**
     * Creates a form record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function createForm(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = FormValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/create', self::API_VERSION, self::FORM_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Update a form record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function updateForm(array $aParams)
    {
        /** Validates parameters */
        $aValidationResult = FormValidator::validate($aParams);
        if ($aValidationResult[AppConstants::DATA] === false) {
            $mResult = $aValidationResult;
        } else {
            /** Build the request url and executes it */
            $sApiRoute = sprintf('/%s/%s/update', self::API_VERSION, self::FORM_API_MODULE);
            $mResult = $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
        }

        return $mResult;
    }

    /**
     * Enable / Disable a form record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function switchUpdateForm(array $aParams)
    {
        /** Build the request url and executes it */
        $sApiRoute = sprintf('/%s/%s/switch', self::API_VERSION, self::FORM_API_MODULE);
        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aParams);
    }

    /**
     * Deactivate a form record
     *
     * @param array $aParams
     * @return array|bool[]|mixed
     */
    public function deactivateForm(array $aParams)
    {
        $aAllowedFields = ['form_id'];
        $aAllowedParams = array_merge(['form_active_status' => 0], ArrayLib::filterKeys($aParams, $aAllowedFields));
        $sApiRoute = sprintf('/v1/%s/update', self::FORM_API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'POST', $aAllowedParams);
    }
}
