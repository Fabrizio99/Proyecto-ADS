<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reporteInvController extends Controller
{

    function getEmitirRI(Request $req){
        $isValidate = isNullEmpty($req->fecha);
        if($isValidate){
            return $isValidate;
        }
        //// el estado 1 es alto en productos y el estado 0 es bajo en productos
        return mySQLConsulta("SELECT id_producto,nombre,precio,stock,(CASE  
        WHEN estado = 1 THEN 'ALTO'
        ELSE CASE WHEN estado = 0 THEN 'BAJO'
        END 
        END ) AS estado FROM
        producto WHERE fecha_mod <= '{$req->fecha}' LIMIT 0,50");
        
    }

   function totalProdCosto (Request $req){
       return  mySQLConsulta("SELECT sum(precio),sum(stock) FROM producto");

   }
}
