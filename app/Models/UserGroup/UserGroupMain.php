<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\UserGroup;

use Illuminate\Database\Eloquent\Model;

class UserGroupMain extends Model
{
    protected $table = 'tb_school_user_group';
    protected $fillable = [    
        'id_user_group',
        'nm_user_group',
        'ic_employee_n_y'
    ];
    protected $hidden = [
        'ic_disable_enable'
    ];
	public $timestamps = false;
    protected $connection = 'main';

}