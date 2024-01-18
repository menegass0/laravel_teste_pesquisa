<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserHasThemeCategory;

use Exception;
use Illuminate\Database\QueryException;

use App\Models\QueryType;
use App\Models\CrudSearch;
use App\Models\MapWhere;

use App\Models\User\UserWhere;
use App\Models\UserGroup\UserGroupWhere;

class UserHasThemeCategorySearch extends UserHasThemeCategoryMain implements CrudSearch
{	

    private $query;
    private $select = [];
    private $pagination = [
        'data' => null,
        'totalPage' => 21
    ];
    private $whereMap = [];
    private $dataDefault = [];

    public function __construct(){

        $this->whereMap();
        $this->whereDefault();

        $this->select = [
            $this->table.'.*'
        ];
    }

    public function setSelect($select = []){
        $this->select = $select;

        return $this;
    }

    public function search(){
        $this->query = 
            parent::select(
                $this->select
            );

        return $this;
    }

    public function joinUser(){
        $this->query = $this->query->join(
            'tb_school_user', 
            'tb_school_user.id_user', '=', $this->table.'.tb_school_user_id_user'
        );

        $this->whereMap = $this->whereMap + UserGroupWhere::$whereArr;

        return $this;
    }

    public function joinUserGroup(){
        $this->query = $this->query->join(
            'tb_school_user_group', 
            'tb_school_user_group.id_user_group', '=', 'tb_school_user.id_user_group'
        );

        $this->whereMap = $this->whereMap + UserGroupWhere::$whereArr;

        return $this;
    }

    public function whereData($data = []){
        try {
            $this->pagination['data'] = $data;

            $data = $data + $this->dataDefault;
         
            if(!empty($data)){
                $this->query = MapWhere::mapsWhere($data, $this->whereMap, $this->query);   
            }           

            return $this;
            
        } catch(QueryException $e){ 
            dd($e);
            return ['msg' => $e->getMessage(), 'status' => 0];
        } catch(Exception $e){ 
            dd($e);
            return ['msg' => $e->getMessage(), 'status' => 0];
        }
    }

    private function whereDefault(){
        $this->dataDefault = [
            'activeUser' => 1,
            'activeUserHasThemeCateg' => 1
        ];
    }

    private function whereMap(){
        $this->whereMap = $this->whereMap + UserHasThemeCategoryWhere::$whereArr;
    }

    public function orderBy($coluna, $type){
        try {
            $this->query = $this->query->orderBy($coluna, $type);

            return $this;

        } catch(QueryException $e){ 
            return ['msg' => $e->getMessage(), 'status' => 0];
        } catch(Exception $e){ 
            return ['msg' => $e->getMessage(), 'status' => 0];
        }
    }

    public function setTotalDataPage($total){
        try {
            $this->pagination['totalPage'] = $total;

            return $this;

        } catch (Exception $e) {
            return ['msg' => $e->getMessage(), 'status' => 0];
        }
    }

    public function finish($queryType){
        try {

            $this->query = QueryType::dataType($this->query, $queryType, $this->pagination);
           
            return $this->query;

        } catch (Exception $e) {
            return ['msg' => $e->getMessage(), 'status' => 0];
        }
    }
}
