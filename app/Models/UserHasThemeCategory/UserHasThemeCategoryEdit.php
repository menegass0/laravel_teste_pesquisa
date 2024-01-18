<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\ModelV2\UserHasThemeCategory;

use Exception;
use Illuminate\Database\QueryException;

use App\ModelV2\UserHasThemeCategory\UserHasThemeCategoryWhere;

class UserHasThemeCategoryEdit extends UserHasThemeCategoryWhere
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

    public function editExit($id, $dateExit){ 

        try { 

            $this->query = parent::where('tb_school_user_has_tb_theme_category.id_user_theme_category', '=', $id); 

            $this->updated = [
                'tb_school_user_has_tb_theme_category.dt_final_user_has_tb_theme_category' => $dateExit
            ];

            return $this->edit();
            
        } catch(Exception $ex){ 
            return ['msg' => 'MODEL: '.$ex->getMessage(), 'status' => 0];
        }
    }

    
}