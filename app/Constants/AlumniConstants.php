<?php

namespace App\Constants;

/**
 * Class AlumniConstants
 * @package App\Constants
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   02/07/2021
 * @version 1.0
 */
class AlumniConstants
{
    /**
     * Constants for api route group
     */
    const API_AL_WORK_EXP = 'work_exp';
    const API_AL_COMPETENCY = 'competency';
    const API_AL_JOB_LEVEL = 'ajle';
    const API_AL_UNEMPLOYED = 'unemploy_reason';
    const API_AL_IMPACT_EDUC = 'ioe';
    const API_AL_SHARED_CONS = 'shared_contacts';

    /**
     * Constants for the alumni id foreign reference
     */
    const AL_WORK_EXP_ALUMNI_REF = 'awe_alumni_id';
    const AL_COMPETENCY_ALUMNI_REF = 'alcom_alumni_id';
    const AL_JOB_LEVEL_ALUMNI_REF = 'ajle_alumni_id';
    const AL_UNEMPLOYED_ALUMNI_REF = 'aur_alumni_id';
    const AL_IMPACT_EDUC_ALUMNI_REF = 'aled_alumni_id';
    const AL_SHARED_ALUMNI_REF = 'asc_shared_by';
}
