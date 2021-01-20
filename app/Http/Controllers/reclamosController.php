<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{

    function getReclamos(Request $req){
        
    //  $isValidate = isNullEmpty($req->codBoleta) ?: isNullEmpty($req->nombre) ?: isNullEmpty($req->documento) ?: isNullEmpty($req->fecha);
        $isValidate = isNullEmpty($req->codBoleta);
    
        if ($isValidate){
            return  $isValidate;
        
        }

        return mySQLConsulta("SELECT * FROM boleta WHERE codBoleta = '{$req->codBoleta}'");
    }

    function postRegistrar(Request $req){

        $isValidate = isNullEmpty($req->descripcion, 'descripcion', 'El campo descripcion no puede ser vacio.') ?:
                      isNullEmpty($req->estado     , 'estado'     , 'El campo estado no puede ser vacio.'     ) ?: 
                      isNullEmpty($req->codBoleta  , 'codBoleta'  , 'El campo codigo de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->solucion   , 'solucion'   , 'El campo solucion no puede ser vacio.'   );
        
        if ($isValidate){
            return  $isValidate;
        }
        
        return mySQLInsert(
            "INSERT INTO reclamo (descripcion,estado,solucion,boleta_idboleta) 
                VALUES ('{$req->descripcion}','{$req->estado}','{$req->solucion}', '{$req->codBoleta}')",
            "Se Registro el reclamo con exito"
        );
    }

}



