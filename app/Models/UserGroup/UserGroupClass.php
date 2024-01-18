<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserGroup;
 
class UserGroupClass {
    
    private $data;
    
    /*
     * array Array
     * inicia todos os atributos da classe
     * all
     */
    public function __construct($data){
        $this->setId($data);
        $this->setName($data);
        $this->setEmployee($data);
    }
    
    public function getCode(){
        return $this->data['code'];
    }

    public function getId(){
        return $this->data['id'];
    }
    
    public function getName($format = null){

        if(strtoupper($format) == 'BR'){
            return mb_strtoupper($this->data["name"], 'UTF-8');
        }
        
        return $this->data['name'];
    }
    
    public function isEmployee(){
        return $this->data['isEmployee'];
    }
    
    public function getAll(){
        return $this->data;
    }

    /****************  SET *********************/

    // INTEGER
    private function setId($data){
        $this->data['id'] = isset($data["id_user_group"]) ? $data["id_user_group"] : 0;
    }

    // TEXT
    private function setName($data){
        $this->data['name'] = isset($data["nm_user_group"]) ? $data["nm_user_group"] : "";
    }

    // BOOLEAN
    private function setEmployee($data){
        $this->data['isEmployee'] = isset($data["ic_employee_n_y"]) ? $data["ic_employee_n_y"] : "";
    }
}