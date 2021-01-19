<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{

    function listarReclamos(Request $req){
        
        // $isValidate = isNullEmpty($req->codBoleta) ?: isNullEmpty($req->nombre) ?: isNullEmpty($req->documento) ?: isNullEmpty($req->fecha);
        
        // if($isValidate) {
        //     return $isValidate;
        // }

        // return mySQLConsulta("SELECT * FROM usuario WHERE codBoleta = '{$req->codBoleta}'");
    }

}
