<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\UserHasThemeCategory;

use Illuminate\Database\Eloquent\Model;

class UserHasThemeCategoryMain extends Model
{
    protected $table = 'tb_school_user_has_tb_theme_category';
    protected $fillable = [    
        'id_user_theme_category', 
        'tb_school_user_id_user', 
        'tb_theme_category_id_theme_category', 
        'tb_school_studying_id_studying', 
        'dt_initial_user_has_tb_theme_category',
        'dt_final_user_has_tb_theme_category',
        'dt_registration_user_has_tb_theme_category',
        'id_situation',
        'ds_user_has_theme_category',
        'ic_user_has_theme_category_scholarship',
        'ic_user_has_theme_category_scholarship_employee'
    ];
    protected $hidden = [
        'ic_disable_enable', 
        'created_id_user', 
        'updated_id_user'
    ];
	public $timestamps = true;
    protected $connection = 'main';

}