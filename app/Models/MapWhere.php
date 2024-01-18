<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB; 

class MapWhere
{   

    private static $arrWhere      = [];
    private static $data          = [];
    private static $whereData     = [];
    private static $query         = null;

    public static function mapsWhere($data, $whereData, $query){

        try {
            self::$data      = $data;
            self::$whereData = $whereData;
            self::$query     = $query;

            self::$arrWhere['arrWhere']     = self::arrWhere();
            self::$arrWhere['arrWhereIn']   = self::arrWhereIn();
            self::$arrWhere['arrWhereNull'] = self::arrWhereNull();
            self::$arrWhere['arrSubWhere']  = self::mapsMultiWhere();

            self::$query = self::whereGenerate(self::$query);

            if(!empty(self::$arrWhere['arrSubWhere'])){

                self::$arrWhere = self::$arrWhere['arrSubWhere'];          
                    
                self::$query = self::$query->where(function($pquery){

                    $pquery = self::whereGenerate($pquery);

                });
            } 

            return self::$query;

        } catch (Exception $e) {
            dd($e);  
        }

    }

    private static function arrWhere(){

        try {

            $arrWhere['where'] = [];
            $arrWhere['orWhere'] = [];

            foreach (self::$data as $key => $value) {

                if(!empty(self::$whereData[$key]['type']) && isset($value) && !is_array($value) && isset($arrWhere[self::$whereData[$key]['method']])){

                    $arrWhere[self::$whereData[$key]['method']][] = [
                        self::$whereData[$key]['coluna'], self::$whereData[$key]['type'], $value
                    ];                     

                    unset(self::$whereData[$key]);
                    unset(self::$data[$key]);
                }              
            }

            return $arrWhere;

        } catch (Exception $e) {
            dd($e);  
        }

    }

    private static function arrWhereIn(){

        try {
            $arrWhere['where'] = [];
            $arrWhere['orWhere'] = [];           

            foreach (self::$data as $key => $value) {

                if(!empty($value) && is_array($value) && isset($arrWhere[self::$whereData[$key]['method']])){

                    $arrWhere[self::$whereData[$key]['method']][] = [
                        'coluna' => self::$whereData[$key]['coluna'],
                        'value' => $value
                    ]; 

                    unset(self::$whereData[$key]);
                    unset(self::$data[$key]);
                }              

            }

            return $arrWhere;

        } catch (Exception $e) {
            dd($e);  
        }

    }

    private static function arrWhereNull(){

        try {
            $arrWhere['where']   = [];
            $arrWhere['orWhere'] = [];

            foreach (self::$data as $key => $value) {

                if(!empty(self::$whereData[$key]['method']) && empty(self::$whereData[$key]['type']) && isset($arrWhere[self::$whereData[$key]['method']])){
                    $arrWhere[self::$whereData[$key]['method']][] = self::$whereData[$key]['coluna']; 

                    unset(self::$whereData[$key]);
                    unset(self::$data[$key]);
                }                

            }

            return $arrWhere;

        } catch (Exception $e) {
            dd($e);  
        }

    }

    private static function mapsMultiWhere(){

        try {

            $data     = self::$data;

            $arrWhere['arrWhere'] = [];
            $arrWhere['arrWhereIn'] = [];
            $arrWhere['arrWhereNull'] = []; 

            foreach ($data as $key => $value) {

                if(!empty(self::$whereData[$key]['multi'])){

                    foreach (self::$whereData[$key]['multi'] as $kQuery => $query) {

                        self::$whereData[$key] = $query;
                        self::$data[$key]      = $value;

                        foreach (self::arrWhere() as $key => $value) {
                            foreach ($value as $keyW => $vWhere) {
                                $arrWhere['arrWhere'][$key][] = $vWhere;
                            }                            
                        }

                        foreach (self::arrWhereIn() as $key => $value) {
                            foreach ($value as $keyW => $vWhere) {
                                $arrWhere['arrWhereIn'][$key][] = $vWhere;
                            }  
                        }

                        foreach (self::arrWhereNull() as $key => $value) {
                            foreach ($value as $keyW => $vWhere) {
                                $arrWhere['arrWhereNull'][$key][] = $vWhere;
                            } 
                        } 
                        
                        
                    }

                }               
            }

            self::$data = $data;

            return $arrWhere;

        } catch (Exception $e) {
            dd($e);  
        }

    }

    private static function whereGenerate($query){
        if(!empty(self::$arrWhere['arrWhere']['where'])){
            $query = $query->where(self::$arrWhere['arrWhere']['where']);
        }

        if(!empty(self::$arrWhere['arrWhere']['orWhere'])){
            $query = $query->orWhere(self::$arrWhere['arrWhere']['orWhere']);
        }

        if(!empty(self::$arrWhere['arrWhereIn']['where'])){
            foreach (self::$arrWhere['arrWhereIn']['where'] as $key => $value) {
                $query = $query->whereIn($value['coluna'], $value['value']);
            }            
        }

        if(!empty(self::$arrWhere['arrWhereNull']['where'])){
            $query = $query->whereNull(self::$arrWhere['arrWhereNull']['where']);
        }     

        if(!empty(self::$arrWhere['arrWhereNull']['orWhere'])){
            $query = $query->orWhereNull(self::$arrWhere['arrWhereNull']['orWhere']);
        }

        return $query;
    }

    public static function mapsUpdate($data, $whereData){

        try {
            $arr = [];

            foreach ($data as $key => $value) {

                if(!empty($value) && isset($whereData[$key])  && $whereData[$key]['method'] == 'where'){
                    $arr[$whereData[$key]['coluna']] = $value; 
                }                
            }

            return $arr;

        } catch (Exception $e) {
            dd($e);  
        }

    }

}