<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\UserGroup;

class UserGroupWhere
{

    /* MAPEAMENTO DE WHERE SEM PRECISAR DE IF */
    public static $whereArr = [
        'groupName' => [
            'method' => 'where',
            'coluna' => 'tb_school_user_group.nm_user_group', 
            'type' => '='
        ]    
    ];

}