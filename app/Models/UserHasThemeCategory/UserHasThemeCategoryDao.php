<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserHasThemeCategory;

use Session;
use Exception;

use App\Models\UserHasThemeCategory\UserHasThemeCategoryClass;
 
class UserHasThemeCategoryDao {

    public static function convertMany($data){     
        $dao = [];
      
        foreach($data as $key => $value){

            $dao[$key] = new UserHasThemeCategoryClass($value);                

        }

        return $dao;
    }

    public static function convert($data){     
        $dao = [];
     
        if(empty($data)){

            return [];

        }

        $dao = new UserHasThemeCategoryClass($data); 

        return $dao;
        
    }
   
}