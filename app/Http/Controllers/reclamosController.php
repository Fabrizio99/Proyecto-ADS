<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{

    function getReclamos(Request $req){
        
     $isValidate = isNullEmpty($req->codBoleta) ?: isNullEmpty($req->nombre) ?: isNullEmpty($req->documento) ?: isNullEmpty($req->fecha);
        $isValidate =isNullEmpty($req->codBoleta);
    
        if ($isValidate){
            return  $isValidate;
        
        }

        return mySQLConsulta("SELECT * FROM boleta WHERE codBoleta = '{$req->codBoleta}'");
    }
        // if($isValidate) {
        //     return $isValidate;
        // }

        // return mySQLConsulta("SELECT * FROM usuario WHERE codBoleta = '{$req->codBoleta}'");
    
    }
    function postRegistrar(Request $req){
        $isValidate = isNullEmpty($req->descripcion) ?: isNullEmpty($req->estado) ?: isNullEmpty($req->solucion);
        if ($isValidate){
            return  $isValidate;
        }
        return mySQLInsert(
            "INSERT INTO reclamo (descripcion,estado,solucion) 
             VALUES ('{$req->descripcion}','{$req->estado}','{$req->solucion}')"
        );
    }


