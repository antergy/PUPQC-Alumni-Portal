<?php

namespace App\Libraries\Common;

/**
 * Class ResponseLib
 * @package App\Libraries\Common
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/20/2020
 * @version 1.0
 */
class ResponseLib
{
    /** Constant for code field */
    const CODE = 'code';
    /** Constant for data field */
    const DATA = 'data';
    /** Constant for message field */
    const MESSAGE = 'message';

    /** Constant message for succeeded create request */
    const SUCCESS_CREATE_MESSAGE = 'Successfully created a new record.';
    /** Constant message for succeeded read request */
    const SUCCESS_RETRIEVE_MESSAGE = 'Successfully retrieved the record(s).';
    /** Constant message for succeeded update request */
    const SUCCESS_UPDATE_MESSAGE = 'Successfully updated the record(s).';
    /** Constant message for succeeded delete request */
    const SUCCESS_DELETE_MESSAGE = 'Successfully deleted the record(s).';
    /** Constant message for deleting non existing record */
    const NO_RECORD_DELETE_MESSAGE = 'There is no record to delete.';

    /**
     * Formats and returns the success response
     *
     * @param array|mixed $mData
     * @param string $sMessage
     * @return array
     */
    public static function formatSuccessResponse($mData = [], $sMessage = 'none')
    {
        return [
            'code'    => 200,
            'data'    => $mData,
            'message' => $sMessage
        ];
    }

    /**
     * Formats and returns the error response
     *
     * @param \Throwable $oException
     * @return array
     */
    public static function formatErrorResponse(\Throwable $oException)
    {
        $iCode = $oException->getCode();
        $sMessage = $oException->getMessage();

        return [
            self::CODE    => $iCode,
            self::DATA    => false,
            self::MESSAGE => $sMessage
        ];
    }
}
