<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\User;

class UserWhere
{

    /* MAPEAMENTO DE WHERE SEM PRECISAR DE IF */
    public static $whereArr = [
        'activeUser' => [
            'method' => 'where',
            'coluna' => 'tb_school_user.ic_disable_enable', 
            'type' => '='
        ]
    ];

}