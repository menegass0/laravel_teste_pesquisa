<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\UserHasThemeCategory;

class UserHasThemeCategoryWhere
{

    /* MAPEAMENTO DE WHERE SEM PRECISAR DE IF */
    public static $whereArr = [
        'activeUserHasThemeCateg' => [
            'method' => 'where',
            'coluna' => 'tb_school_user_has_tb_theme_category.ic_disable_enable', 
            'type' => '='
        ],
        'studyId' => [
            'method' => 'where',
            'coluna' => 'tb_school_user_has_tb_theme_category.tb_school_studying_id_studying', 
            'type' => '='
        ],
        'activeEnrollment' => [
            'multi' => [
                [
                    'method' => 'where',
                    'coluna' => 'tb_school_user_has_tb_theme_category.dt_final_user_has_tb_theme_category', 
                    'type' => '>='
                ],
                [
                    'method' => 'orWhere',
                    'coluna' => 'tb_school_user_has_tb_theme_category.dt_final_user_has_tb_theme_category', 
                    'type' => null
                ]
            ]
        ]   
    ];

}