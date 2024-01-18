<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\User;

use Session;
use Exception;

use App\Models\User\UserClass;
 
class UserDao {

    public static function convertMany($data){     
        $dao = [];
      
        foreach($data as $key => $value){

            $dao[$key] = new UserClass($value);                

        }

        return $dao;
    }

    public static function convert($data){     
        $dao = [];
     
        if(empty($data)){

            return [];

        }

        $dao = new UserClass($data); 

        return $dao;
        
    }
   
}