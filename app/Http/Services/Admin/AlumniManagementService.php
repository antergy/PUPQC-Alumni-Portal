<?php

namespace App\Http\Services\Admin;

use App\Constants\AppConstants;
use App\Constants\AlumniConstants as AlConst;
use App\Core\Admin\CoreAdminService;

/**
 * Class AlumniManagementService
 * @package App\Http\Services\Admin\
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/07/2021
 * @version 1.0
 */
class AlumniManagementService extends CoreAdminService
{
    /**
     * API module for alumni management
     */
    const API_MODULE = 'alumni';

    /**
     * List alumni
     *
     * @param array $aParams
     * @return array|mixed
     */
    public function listAlumni($aParams)
    {
        $sApiRoute = sprintf('/v1/%s/read', self::API_MODULE);

        return $this->sendInternalApiRequest($sApiRoute, 'GET', $aParams);
    }

    /**
     * Get alumni details
     *
     * @param int $iAlumniId
     * @return array
     */
    public function getAlumniDetails($iAlumniId)
    {
        $sWorkExpApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_WORK_EXP);
        $aWorkExpDetails = $this->sendInternalApiRequest($sWorkExpApiRoute, 'GET', [AlConst::AL_WORK_EXP_ALUMNI_REF => $iAlumniId]);

        $sUnemployedReasonApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_UNEMPLOYED);
        $aUnemployedReasonDetails = $this->sendInternalApiRequest($sUnemployedReasonApiRoute, 'GET', [AlConst::AL_UNEMPLOYED_ALUMNI_REF => $iAlumniId]);

        $sJobLevelApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_JOB_LEVEL);
        $aJobLevelDetails = $this->sendInternalApiRequest($sJobLevelApiRoute, 'GET', [AlConst::AL_JOB_LEVEL_ALUMNI_REF => $iAlumniId]);

        $sSharedContactApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_SHARED_CONS);
        $aSharedContactDetails = $this->sendInternalApiRequest($sSharedContactApiRoute, 'GET', [AlConst::AL_SHARED_ALUMNI_REF => $iAlumniId]);

        $aCompleteDetails = [
            AppConstants::DATA =>
                ['work_exp'          => data_get($aWorkExpDetails, AppConstants::DATA, []),
                 'unemployed_reason' => data_get($aUnemployedReasonDetails, AppConstants::DATA, []),
                 'job_level'         => data_get($aJobLevelDetails, AppConstants::DATA, []),
                 'shared_contact'    => data_get($aSharedContactDetails, AppConstants::DATA,[])
                ],
            AppConstants::MESSAGE => 'Successfully retrieved all the details'
        ];

        return $aCompleteDetails;
    }

    /**
     * Get alumni reflection details
     *
     * @param int $iAlumniId
     * @return array
     */
    public function getAlumniReflectionDetails($iAlumniId)
    {
        $sCompetencyApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_COMPETENCY);
        $aCompetencyDetails = $this->sendInternalApiRequest($sCompetencyApiRoute, 'GET', [AlConst::AL_COMPETENCY_ALUMNI_REF => $iAlumniId]);

        $sImpactEducApiRoute = sprintf('/v1/%s/%s/read', self::API_MODULE, AlConst::API_AL_IMPACT_EDUC);
        $aImpactEducDetails = $this->sendInternalApiRequest($sImpactEducApiRoute, 'GET', [AlConst::AL_IMPACT_EDUC_ALUMNI_REF => $iAlumniId]);

        $aCompleteReflectionDetails = [
            AppConstants::DATA    =>
                ['competencies' => data_get($aCompetencyDetails, AppConstants::DATA, []),
                 'impact_educ'  => data_get($aImpactEducDetails, AppConstants::DATA, []),
                ],
            AppConstants::MESSAGE => 'Successfully retrieved all the details'
        ];

        return $aCompleteReflectionDetails;
    }

    /**
     * Gets the alumni id from the request
     *
     * @param object $oRequest
     * @return false|int
     */
    public function getAlumniId($oRequest)
    {
        $iAlumniId = $oRequest->input('al_id');
        if ($iAlumniId === null || $iAlumniId === '') {
            return false;
        } else {
            return $iAlumniId;
        }
    }

    /**
     * Creates an alumni record
     */
    public function createAlumni()
    {
        //@TODO (Insert Code Here)
    }

    /**
     * Updates an alumni record
     */
    public function updateAlumni()
    {
        //@TODO (Insert Code Here)
    }

}
