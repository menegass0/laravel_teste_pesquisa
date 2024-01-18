<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\ModelV2\User;

use Exception;
use Illuminate\Database\QueryException;
use Hash;

use App\ModelV2\CrudRegister;

class UserRegister extends UserMain implements CrudRegister
{	
	public function register($data){
        
        try {
            $where = [
                'cd_cpf_user' => $data['userCpf']
            ];

            $query = 
                parent::select('id_user', 'uuid_user')->where($where)->first();
        
            if(!empty($query)){
                return [
                    'id' => $query->id_user, 
                    'uuid' => $query->uuid_user,
                    'msg' => 'Usuário já cadastrado', 
                    'status' => 1
                ]; 
            }

            $result = [];

            foreach ($this->fillable as $key => $value) {
                foreach ($data as $key2 => $value2) {
                    if($key == $key2){
                        $result[$value] = $value2;
                        unset($data[$key2]);
                    }
                }
            }
            
            $uuid = uniqid();
            $result['uuid_user'] = $uuid;
            $result['created_at'] = \Carbon\Carbon::now();
            $result['cd_qrcode_user'] = Hash::make(uniqid());

            $query =
                parent::insertGetId
                ($result);

            if($query == 0){
                throw new Exception("Erro ao lançar dados");                
            }

            return [
                'id' => $query, 
                'uuid' => $uuid,
                'msg' => 'Dados cadastrados com sucesso', 
                'status' => 1
            ];
            
        } catch(QueryException $ex){ 
            return ['msg' => $ex->getMessage(), 'status' => 0];
        } catch(Exception $ex){ 
            return ['msg' => $ex->getMessage(), 'status' => 0];
        }
        
    }
}