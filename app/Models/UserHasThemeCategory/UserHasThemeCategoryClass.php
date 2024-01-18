<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserHasThemeCategory;

use App\Models\Studying\StudyingClass;
use App\Models\ThemeCategory\ThemeCategoryClass;
use App\Models\User\UserClass;

 
class UserHasThemeCategoryClass {
    
    private $data;
    
    /*
     * array Array
     * inicia todos os atributos da classe
     * all
     */
    public function __construct($data){
        $this->setId($data);
        $this->setUser($data);
        $this->setThemeCategory($data);
        $this->setStudying($data);
        $this->setThemeCateg($data);
        $this->setDateInit($data);
        $this->setDateFinal($data);
        $this->setDateRegistration($data);
        $this->setGenerateBillet($data);
    }
    
    public function getId(){
        return $this->data['id'];
    }

    public function getUser(){
        return $this->data['user'];
    }
    
    public function getThemeCategory(){
        return $this->data['themeCategory'];
    }

    public function getThemeCateg(){
        return $this->data['themeCateg'];
    }

    public function getStudying(){
        return $this->data['studying'];
    }

    public function getDateInit($format = null){

        if(strtoupper($format) == 'BR'){
            return date('d/m/Y', strtotime($this->data['dateInit']));
        }

        return $this->data['dateInit'];
    }

    public function getDateFinal($format = null){

        if(strtoupper($format) == 'BR'){
            return date('d/m/Y', strtotime($this->data['dateFinal']));
        }
        
        return $this->data['dateFinal'];
    }

    public function getDateRegistration($format = null){

        if(strtoupper($format) == 'BR'){
            return date('d/m/Y', strtotime($this->data['registration']));
        }
        
        return $this->data['registration'];
    }

    public function getUserRelocated(){

        if(date('Y-m-d') > $this->getDateFinal() && date('Y', strtotime($this->getDateFinal())) == date('Y')){
            return true;
        }

        return false;
    }

    public function getGenerateBillet(){
        return $data['generateBillet'];
    }

    
    
    public function getAll(){
        return $this->data;
    }

    /****************  SET *********************/

    // INTEGER
    private function setId($data){
        $this->data['id'] = isset($data['id_user_theme_category']) ? $data['id_user_theme_category'] : 0;
    }

    // INTEGER
    private function setUser($data){
        $this->data['user'] = new UserClass($data);
    }
    
    // CLASS
    private function setThemeCategory($data){
        $this->data['themeCategory'] = isset($data['tb_theme_category_id_theme_category']) ? $data['tb_theme_category_id_theme_category'] : null;
    }

    // CLASS
    private function setThemeCateg($data){
        $this->data['themeCateg'] = new ThemeCategoryClass($data);
    }

    // CLASS
    private function setStudying($data){
        $this->data['studying'] = new StudyingClass($data);
    }

    // DATE
    private function setDateInit($data){
        $this->data['dateInit'] = isset($data['dt_initial_user_has_tb_theme_category']) ? $data['dt_initial_user_has_tb_theme_category'] : null;
    }

    // DATE
    private function setDateFinal($data){
        $this->data['dateFinal'] = isset($data['dt_final_user_has_tb_theme_category']) ? $data['dt_final_user_has_tb_theme_category'] : null;
    }

    // DATE
    private function setDateRegistration($data){
        $this->data['registration'] = isset($data['dt_registration_user_has_tb_theme_category']) ? $data['dt_registration_user_has_tb_theme_category'] : null;
    }

    // BOOL
    private function setGenerateBillet($data){
        $this->data['generateBillet'] = isset($data['ic_user_has_theme_category_generate_billet']) ? $data['ic_user_has_theme_category_generate_billet'] : null;
    }
    
}