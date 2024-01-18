<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\ModelV2\User;

use Exception;
use Illuminate\Database\QueryException;

use App\ModelV2\User\UserWhere;

class UserEdit extends UserWhere
{	

    private $query = null;
    private $updated = null;

    public function __construct(){

    }

    private function edit(){
        try {
            $this->query = 
                $this->query->update(
                    $this->updated
                );

            return ['msg' => 'Dados atualizados com sucesso', 'status' => 1];

        } catch(QueryException $ex){ 
            return ['msg' => 'MODEL: '.$ex->getMessage(), 'status' => 0];
        } catch(Exception $ex){ 
            return ['msg' => 'MODEL: '.$ex->getMessage(), 'status' => 0];
        }
    }

    public function editSituation($id, $situation){ 

        try { 

            $this->query = parent::where('tb_school_user.id_user', '=', $id); 

            $this->updated = [
                'tb_school_user.cd_situation_user' => $situation
            ];

            return $this->edit();
            
        } catch(Exception $ex){ 
            return ['msg' => 'MODEL: '.$ex->getMessage(), 'status' => 0];
        }
    }

    public function editData($id, $arrData){ 

        try {      
            
            $result = [];

            foreach ($this->fillable as $key => $value) {
                foreach ($arrData as $key2 => $value2) {
                    if($key == $key2){
                        $result[$value] = $value2;
                        unset($arrData[$key2]);
                    }
                }
            }
    
            $this->query = parent::where('tb_school_user.id_user', '=', $id); 

            $this->updated = $result;

            return $this->edit();
            
        } catch(Exception $ex){ 
            return ['msg' => 'MODEL: '.$ex->getMessage(), 'status' => 0];
        }
    }

    
}