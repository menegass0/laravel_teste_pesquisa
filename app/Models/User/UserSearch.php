<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */

namespace App\Models\User;

use Exception;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\QueryException;

use App\Models\QueryType;
use App\Models\CrudSearch;
use App\Models\MapWhere;

class UserSearch extends UserMain implements CrudSearch
{	

    private $query;
    private $select = [];
    private $pagination = [
        'data' => null,
        'totalPage' => 21
    ];

    public function __construct($queryType){
        $this->queryType = $queryType;

        $this->select = [
            $this->table.'.*'
        ];
    }

    public function setSelect($select = []){
        $this->select = $select;

        return $this;
    }

    public function search($data = []){
        try {

            $this->query = 
                parent::select(
                    $this->select
                );

            if(!empty($data)){
                $arrData = MapWhere::mapsWhere($data, $this->whereArr);
                $arrDataMulti = MapWhere::mapsWhereIn($data, $this->whereArr);
                $arrNull = MapWhere::mapsWhereNull($data, $this->whereArr);
            }
            

            if(!empty($arrData)){
                $this->query = $this->query->where($arrData);
            }

            if(!empty($arrDataMulti)){
                $this->query = $this->query->whereIn($arrDataMulti);
            }

            if(!empty($arrNull)){
                $this->query = $this->query->whereNull($arrNull);
            }

            $this->pagination['data'] = $data;

            return $this;
            
        } catch(QueryException $e){ 
            dd($e);
            return ['msg' => $e->getMessage(), 'status' => 0];
        } catch(Exception $e){ 
            dd($e);
            return ['msg' => $e->getMessage(), 'status' => 0];
        }
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
