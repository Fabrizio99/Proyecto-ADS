<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reporteInvController extends Controller
{

    function getEmitirRI(Request $req){
        //$isValidate = isNullEmpty($req->fecha);
        //if($isValidate){
            //return $isValidate;
       // }
        
       // return mySQLConsulta("SELECT * FROM producto WHERE fecha_mod <='{$req->fecha}'");
       // se valida la fecha para traer de la tabla productos 
   }
}
