<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models;

class QueryType
{

    public static function dataType($query, $icGetPaginate, $pagination = ['data' => null, 'totalPage' => 21, 'pageNumber' => null]){

        $queryData = $query;

        if($icGetPaginate == 4){
            $queryData = $queryData->distinct();
         }

        if($icGetPaginate == 0 || $icGetPaginate == 4){

            return $queryData->get();

        }elseif($icGetPaginate == 1){
            if(empty($pagination['pageNumber'])){
                $queryData = $queryData->paginate($pagination['totalPage']);
            }else{
                $queryData = $queryData->paginate($pagination['totalPage'], ['*'], 'page', $pagination['pageNumber']);
            }
            
                    
            if(!empty($queryData)){
                $queryData->appends($pagination['data'])->links(); 
            }

            return $queryData;

        }elseif($icGetPaginate == 2){
            return $queryData->count();
        }else{      
            return $queryData->first();
        }
          
        return $queryData;

    }

}