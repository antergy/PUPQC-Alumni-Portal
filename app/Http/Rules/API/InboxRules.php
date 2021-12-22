<?php

namespace App\Http\Rules\API;

/**
 * Class InboxRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/19/2021
 * @version 1.0
 */
class InboxRules
{
    /**
     * Rules for creating a inbox record
     *
     * @var \string[][]
     */
    public $aMessageCreate = [
        'in_subject' => [
            'required',
            'string',
        ],
        'in_message' => [
            'required',
        ],
        'in_acc_id_from' => [
            'required',
            'integer'
        ],
        'in_acc_id_to' => [
            'required',
            'integer'
        ],
        'in_is_reply' => [
            'integer'
        ],
        'in_inbox_id' => [
            'integer'
        ],
    ];
}
