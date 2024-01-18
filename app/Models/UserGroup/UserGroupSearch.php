<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\UserGroup;

use Exception;
use Illuminate\Database\QueryException;

use App\Models\QueryType;
use App\Models\CrudSearch;
use App\Models\MapWhere;

class UserGroupSearch extends UserGroupMain implements CrudSearch
{	

    private $query;
    private $select = [];
    private $pagination = [
        'data' => null,
        'totalPage' => 21
    ];
    private $whereMap = [];

    public function __construct(){

        $this->whereMap();

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

        return $this;
    }

    public function joinUserGroup(){
        $this->query = $this->query->join(
            'tb_school_user_group', 
            'tb_school_user_group.id_user_group', '=', 'tb_school_user.id_user_group'
        );

        return $this;
    }

    public function whereData($data = []){
        try {
            $this->pagination['data'] = $data;

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

    private function whereMap(){
        $this->whereMap = UserHasThemeCategoryWhere::$whereArr;
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
