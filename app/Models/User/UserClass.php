<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\User;

use App\Models\UserGroup\UserGroupClass;

class UserClass {
    
    private $data;
    
    /*
     * array Array
     * inicia todos os atributos da classe
     * all
     */
    public function __construct($data){
        $this->setId($data);
        $this->setUuid($data);
        $this->setName($data);
        $this->setImage($data);
        $this->setStudentRecord($data);
        $this->setBirth($data);
        $this->setCityBirth($data);
        $this->setStateBirth($data);        
        $this->setEmail($data);
        $this->setCpf($data);
        $this->setRg($data);
        $this->setInitialRg($data);
        $this->setEmissionRg($data);
        $this->setMaritalStatus($data);
        $this->setStreet($data);
        $this->setAdressNumber($data);
        $this->setNeighborhood($data);
        $this->setAdressComplement($data);
        $this->setCity($data);
        $this->setState($data);
        $this->setCep($data);
        $this->setNote($data);
        $this->setCompany($data);
        $this->setContactCompany($data);
        $this->setFirstContact($data);
        $this->setSecondContact($data);
        $this->setGroup($data);
        $this->setParent($data);
        $this->setSituation($data);
        $this->setToken($data);
        $this->setNick($data);
        $this->setQrCode($data);
        $this->setCodeSchool($data);
        $this->setUpdated($data);
    }

    public function getId(){
        return $this->data['id'];
    }

    public function getUuid(){
        return $this->data['uuid'];
    }

    public function getImage(){
        return $this->data['image'];
    }

    public function getUrlProfile(){
        if(!empty($this->data['image'])){
            return '/storage/user/profile/'.substr($this->data['image'], 0, 1).'/'.$this->data['image']."?".date("H:i:s");
        }else{
            return '/images/all/avatar.png';
        }
        
    }

    public function getUserSchool(){
        return $this->data['user_school'];
    }
    
    public function getName($format = null){

        if(strtoupper($format) == 'BR'){
            return mb_strtoupper($this->data["name"], 'UTF-8');
        }
        
        return $this->data['name'];
    }
    
    public function getStudentRecord(){
        return $this->data['student_record'];
    }
    
    public function getBirth($format = null){

        if(strtoupper($format) == 'BR'){
            return date('d/m/Y', strtotime($this->data['birth']));
        }

        return $this->data['birth'];
    }
    
    public function getBirthBr(){
        return !is_null($this->getBirth()) ? date('d/m/Y', strtotime($this->getBirth())) : null;
    }

    public function getCityBirth(){
        return $this->data['cityBirth'];
    }

    public function getStateBirth(){
        return $this->data['stateBirth'];
    }
    
    public function getEmail(){
        return $this->data['email'];
    }
    
    public function getCpf(){
        return $this->data['cpf'];
    }
    
    public function getRg(){
        return $this->data['rg'];
    }

    public function getInitialsRg(){
        return $this->data['initials_rg'];
    }

    public function getEmissionRg(){
        return $this->data['emission_rg'];
    }

    public function getEmissionRgBr(){
        return !is_null($this->getEmissionRg()) ? date('d/m/Y', strtotime($this->getEmissionRg())) : null;
    }

    public function getStatusMarital(){
        return $this->data['marital_status'];
    }

    public function getCompleAddress(){
        if(!empty($this->getStreet())){
            return $this->getStreet().", ".
                $this->getNumberAddress()." - ".
                $this->getNeighborhood().", ".
                $this->getCity()."/".
                $this->getState();
        }

        return "ENDEREÇO NÃO CADASTRADO";
        
    }

    public function getCompleteAddress($format = null){
        $address = null;

        if(!empty($this->getStreet())){
            $address = $this->getStreet().", ".
                $this->getNumberAddress()." - ".
                $this->getNeighborhood().", ".
                $this->getCity()."/".
                $this->getState();

            if(strtoupper($format) == 'BR'){
                return mb_strtoupper($address, 'UTF-8');
            }

            return $address;
        }

        return "ENDEREÇO NÃO CADASTRADO";
        
    }
    
    public function getStreet(){
        return $this->data['street'];
    }

    public function getNumberAddress(){
        if(empty($this->data['address_number'])){
            $this->data['address_number'] = 'S\N';
        }
        
        return $this->data['address_number'];
    }

    public function getNeighborhood(){
        return $this->data['neighborhood'];
    }

    public function getComplementAddress(){
        return $this->data['address_complement'];
    }

    public function getCity(){
        return $this->data['city'];
    }

    public function getState(){
        return $this->data['state'];
    }

    public function getCep(){
        return $this->data['cep'];
    }

    public function getNote(){
        return $this->data['note'];
    }

    public function getCompany(){
        return $this->data['company'];
    }

    public function getContactCompany(){
        return $this->data['contact_company'];
    }

    public function getFirstContact(){
        return $this->data['first_contact'];
    }

    public function getFirstContactNoDDD(){
        $dd = substr($this->data['first_contact'], 0, 4);

        return str_replace([$dd," "], "", $this->data['first_contact']);
    }

    public function getFirstContactDDD(){
        $dd = substr($this->data['first_contact'], 0, 4);

        return str_replace(["(", ")"], "", $dd);
    }
    
    public function getSecondContact(){
        return $this->data['second_contact'];
    }
    
    public function getContacts(){
        $contact = $this->data['first_contact'];

        $contact .= !empty($this->data['second_contact']) ? ", ".$this->data['second_contact'] : null;

        return $contact;
    }

    public function getGroup(){
        return $this->data['group'];
    }
    
    public function getParent(){
        return $this->data['parent'];
    }
    
    public function getToken(){
        return $this->data['token'];
    }
    
    public function getNick(){
        return $this->data['nick'];
    }

    public function changeSituation($status_help = false){
        if($status_help == true && $this->data['situation'] == "ATIVO"){
            $this->data['situation'] = "REMANEJADO";
        }
    }

    public function getLabelSituation(){       
        return $this->data['situation'];
    }
    
    public function getSituation(){       
        
        if($this->data['situation'] == "TRANSFERIDO"){
            return ["color" => "uk-text-warning", "situation" => $this->data['situation']];
        }else if($this->data['situation'] == "EXPULSO"){
            return ["color" => "uk-text-danger", "situation" => $this->data['situation']];    
        }else if($this->data['situation'] == "INATIVO"){
            return ["color" => "uk-text-muted", "situation" => $this->data['situation']];    
        }else if($this->data['situation'] == "REMANEJADO"){
            return ["color" => "uk-text-danger", "situation" => $this->data['situation']];    
        }
        
        return ["color" => "uk-text-primary", "situation" => $this->data['situation']];
    }

    public function getSituationColor(){       
        
        if($this->data['situation'] == "TRANSFERIDO"){
            return 'warning';
        }else if($this->data['situation'] == "EXPULSO"){
            return 'danger';   
        }else if($this->data['situation'] == "INATIVO"){
            return 'muted';    
        }else if($this->data['situation'] == "REMANEJADO"){
            return 'danger';  
        }
        
        return 'success'; 
    }
    
    public function getQrCode(){
        return $this->data['qrcode'];
    }

    public function getUpdated(){
        return $this->data['updated'];
    }
    
    public function getAll(){
        return $this->data;
    }

    /****************  SET *********************/

    // INTEGER
    private function setId($data){
        $this->data['id'] = isset($data["id_user"]) ? $data["id_user"] : 0;
    }

    // TEXT
    private function setUuid($data){
        $this->data['uuid'] = isset($data["uuid_user"]) ? $data["uuid_user"] : '';
    }

    // TEXT
    private function setName($data){
        $this->data['name'] = isset($data["nm_user"]) ? $data["nm_user"] : "";
    }

    // TEXT
    private function setImage($data){
        $this->data['image'] = isset($data["im_user"]) ? $data["im_user"] : "";
    }

    // TEXT
    private function setStudentRecord($data){
        $this->data['student_record'] = isset($data["cd_student_record_user"]) ? $data["cd_student_record_user"] : "";
    }

    // DATE
    private function setBirth($data){
        $this->data['birth'] = isset($data["dt_birth_user"]) ? $data["dt_birth_user"] : null;
    }

    // TEXT
    private function setCityBirth($data){
        $this->data['cityBirth'] = isset($data["ds_user_city_birth"]) ? $data["ds_user_city_birth"] : null;
    }

    // TEXT
    private function setStateBirth($data){
        $this->data['stateBirth'] = isset($data["sg_user_state_birth"]) ? $data["sg_user_state_birth"] : null;
    }

    // TEXT
    private function setEmail($data){
        $this->data['email'] = isset($data["ds_email_user"]) ? $data["ds_email_user"] : null;
    }

    // TEXT
    private function setCpf($data){
        $this->data['cpf'] = isset($data["cd_cpf_user"]) ? $data["cd_cpf_user"] : null;
    }

    // TEXT
    private function setRg($data){
        $this->data['rg'] = isset($data["cd_rg_user"]) ? $data["cd_rg_user"] : null;
    }

    // TEXT
    private function setInitialRg($data){
        $this->data['initials_rg'] = isset($data["sg_rg_user"]) ? $data["sg_rg_user"] : null;
    }

    // TEXT
    private function setEmissionRg($data){
        $this->data['emission_rg'] = isset($data["dt_rg_user"]) ? $data["dt_rg_user"] : null;
    }

    // TEXT
    private function setMaritalStatus($data){
        $this->data['marital_status'] = isset($data["ds_marital_status_user"]) ? $data["ds_marital_status_user"] : null;
    }

    // TEXT
    private function setStreet($data){
        $this->data['street'] = isset($data["nm_address_street_user"]) ? $data["nm_address_street_user"] : null;
    }

    // TEXT
    private function setAdressNumber($data){
        $this->data['address_number'] = isset($data["nm_address_number_user"]) ? $data["nm_address_number_user"] : null;
    }

    // TEXT
    private function setNeighborhood($data){
        $this->data['neighborhood'] = isset($data["nm_address_neighborhood_user"]) ? $data["nm_address_neighborhood_user"] : null;
    }

    // TEXT
    private function setAdressComplement($data){
        $this->data['address_complement'] = isset($data["nm_address_complement_user"]) ? $data["nm_address_complement_user"] : null;
    }

    // TEXT
    private function setCity($data){
        $this->data['city'] = isset($data["nm_address_city_user"]) ? $data["nm_address_city_user"] : null;
    }

    // TEXT
    private function setState($data){
        $this->data['state'] = isset($data["sg_address_state_user"]) ? $data["sg_address_state_user"] : null;
    }

    // TEXT
    private function setCep($data){
        $this->data['cep'] = isset($data["cd_address_cep_user"]) ? $data["cd_address_cep_user"] : null;
    }

    // TEXT
    private function setNote($data){
        $this->data['note'] = isset($data["nm_note_user"]) ? $data["nm_note_user"] : null;
    }

    // TEXT
    private function setCompany($data){
        $this->data['company'] = isset($data["nm_company_user"]) ? $data["nm_company_user"] : null;
    }

    // TEXT
    private function setContactCompany($data){
        $this->data['contact_company'] = isset($data["ds_contact_company_user"]) ? $data["ds_contact_company_user"] : null;
    }

    // TEXT
    private function setFirstContact($data){
        $this->data['first_contact'] = isset($data["ds_first_contact_user"]) ? $data["ds_first_contact_user"] : null;
    }

    // TEXT
    private function setSecondContact($data){
        $this->data['second_contact'] = isset($data["ds_second_contact_user"]) ? $data["ds_second_contact_user"] : null;
    }

    // TEXT
    private function setGroup($data){
        $this->data['group'] = new UserGroupClass($data);
    }

    // TEXT
    private function setParent($data){
        $this->data['parent'] = isset($data["nm_user_responsible"]) ? $data["nm_user_responsible"] : null;
    }

    // TEXT
    private function setSituation($data){
        $this->data['situation'] = isset($data["cd_situation_user"]) ? $data["cd_situation_user"] : null;
    }

    // TEXT
    private function setToken($data){
        $this->data['token'] = isset($data["cd_token"]) ? $data["cd_token"] : null;
    }

    // TEXT
    private function setNick($data){
        $this->data['nick'] = isset($data["nm_nick_user"]) ? $data["nm_nick_user"] : null;
    }

    // TEXT
    private function setQrCode($data){
        $this->data['qrcode'] = isset($data["cd_qrcode_user"]) ? $data["cd_qrcode_user"] : null;
    }

    // TEXT
    private function setCodeSchool($data){
        $this->data['user_school'] = isset($data["cd_user_school"]) ? $data["cd_user_school"] : null;
    }    

    // DATETIME
    private function setUpdated($data){
        $this->data['updated'] = isset($data["updated_at"]) ? $data["updated_at"] : null;
    }  
    
}