<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Core\Admin\CoreAdminService;
use App\Constants\AlumniConstants as AlConst;

/**
 * Class AlumniManagementService
 * @package App\Http\Services\Admin\
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/07/2021
 * @version 1.0
 */
class AlumniManagementService extends CoreAdminService
{
    const API_MODULE = 'alumni';

    public function listAlumni($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/read', self::API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    public function getAlumniDetails($iAlumniId)
    {
        $sWorkExpApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_WORK_EXP);
        $aWorkExpDetails = $this->sendInternalApiRequest($sWorkExpApiRoute, 'GET', [AlConst::AL_WORK_EXP_ALUMNI_REF => $iAlumniId]);

        $sUnemployedReasonApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_UNEMPLOYED);
        $aUnemployedReasonDetails = $this->sendInternalApiRequest($sUnemployedReasonApiRoute, 'GET', [AlConst::AL_UNEMPLOYED_ALUMNI_REF => $iAlumniId]);

        $sJobLevelApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_JOB_LEVEL);
        $aJobLevelDetails = $this->sendInternalApiRequest($sJobLevelApiRoute, 'GET', [AlConst::AL_JOB_LEVEL_ALUMNI_REF => $iAlumniId]);

        $aCompleteDetails = [
            AppConstants::DATA => array_merge(
            ['work_exp' => data_get($aWorkExpDetails, AppConstants::DATA, [])],
            ['unemployed_reason' => data_get($aUnemployedReasonDetails, AppConstants::DATA, [])],
            ['job_level' => data_get($aJobLevelDetails, AppConstants::DATA, [])]
        ),
            AppConstants::MESSAGE => 'Successfully retrieved all the details'];

        return $aCompleteDetails;
    }

    public function getAlumniId($oRequest)
    {
        $iAlumniId = $oRequest->input('al_id');
        if ($iAlumniId === null || $iAlumniId === '') {
            return false;
        } else {
            return $iAlumniId;
        }
    }

}
