<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserGroup;

use Session;
use Exception;

use App\Models\UserGroup\UserGroupClass;
 
class UserGroupDao {

    public static function convertMany($data){     
        $dao = [];
      
        foreach($data as $key => $value){

            $dao[$key] = new UserGroupClass($value);                

        }

        return $dao;
    }

    public static function convert($data){     
        $dao = [];
     
        if(empty($data)){

            return [];

        }

        $dao = new UserGroupClass($data); 

        return $dao;
        
    }
   
}