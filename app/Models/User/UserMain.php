<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserMain extends Model
{
    protected $table = 'tb_school_user';
    protected $fillable = [    
        'userId'            => 'id_user',
        'userUuid'          => 'uuid_user',
        'userName'          => 'nm_user', 
        'userImage'         => 'im_user',
        'userStudentRecord' => 'cd_student_record_user',
        'userBirth'         => 'dt_birth_user',
        'userCityBirth'     => 'ds_user_city_birth',
        'userStateBirth'    => 'sg_user_state_birth',
        'userEmail'         => 'ds_email_user', 
        'userCpf'           => 'cd_cpf_user', 
        'userRg'            => 'cd_rg_user',
        'userRgInitial'     => 'sg_rg_user',
        'userRgEmission'    => 'dt_rg_user',
        'userMaritalStatus' => 'ds_marital_status_user',
        'userContactFirst'  => 'ds_first_contact_user',
        'userContactSecond' => 'ds_second_contact_user',
        'userStreet'        => 'nm_address_street_user',
        'userNumberAddress' => 'nm_address_number_user',
        'userNeighborhood'  => 'nm_address_neighborhood_user',
        'userComplement'    => 'nm_address_complement_user',
        'userCity'          => 'nm_address_city_user',
        'userState'         => 'sg_address_state_user',
        'userCep'           => 'cd_address_cep_user',
        'userNote'          => 'nm_note_user',
        'userCompany'       => 'nm_company_user',
        'userCompanyContact'=> 'ds_contact_company_user',
        'userSituation'     => 'cd_situation_user',
        'userQrCode'        => 'cd_qrcode_user',
        'userSchoolCode'    => 'cd_user_school',
        'userGroupId'       => 'id_user_group',
        'userCreatedId'     => 'created_id_user',
        'userUpdatedId'     => 'updated_id_user'
    ];
    protected $hidden = [
        'ic_disable_enable', 
        'created_at', 
        'updated_at'
    ];
	public $timestamps = true;
    protected $connection = 'main';

}