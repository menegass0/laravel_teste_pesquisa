<?php

/*
 * AUTOR: JORGE NUNES DA SILVA NETO
 * REGRA DE NEGOCIO: 
 *
 */
 
namespace App\Models;

interface CrudSearch
{
    public function whereData($data);
    public function finish($queryType);
}