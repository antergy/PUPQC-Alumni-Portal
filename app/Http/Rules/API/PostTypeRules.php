<?php

namespace App\Http\Rules\API;

/**
 * Class PostTypeRules
 * @package App\Http\Rules\API
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   01/12/2021
 * @version 1.0
 */
class PostTypeRules
{
    /**
     * Rules for creating post type record
     *
     * @var \string[][]
     */
    public $aPostTypeCreate = [
        'pt_desc' => [
            'required',
            'max:50'
        ]
    ];
}
