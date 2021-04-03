<?php

namespace App\Http\Rules\API;

/**
 * Class VisitLogsRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/15/2021
 * @version 1.0
 */
class VisitLogsRules
{
    /**
     * Rules for creating visit log record
     *
     * @var \string[][]
     */
    public $aVisitLogsCreate = [
        'vs_acc_id' => [
            'required',
            'integer',
            'exists:t_accounts,acc_id'
        ],
    ];
}
