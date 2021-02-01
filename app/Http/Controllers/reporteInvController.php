<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reporteInvController extends Controller
{
// lista productos
    function getEmitirRI(Request $req){
        $TIPO_ALTO = 0;
        $TIPO_BAJO = 1;
        
        //// el estado 1 es alto en productos y el estado 0 es bajo en productos
        return mySQLConsulta(
            "SELECT id_producto,
                    nombre,
                    precio,
                    stock,
                    (CASE WHEN stock > 10 
                          THEN 'ALTO'
                     ELSE 'BAJO' 
                    END) AS estado 
               FROM producto 
              WHERE (CASE WHEN '{$req->tipoStock}' = '{$TIPO_ALTO}'  
                          THEN stock > 10
                          WHEN '{$req->tipoStock}' = '{$TIPO_BAJO}'
                          THEN stock <= 10  
                          ELSE 1 = 1 
                    END)
              LIMIT 0,50"
        );
        
    }

   function totalProdCosto (Request $req){
       return  mySQLConsulta("SELECT sum(precio),sum(stock) FROM producto");

   }
}
