<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{

    function listarReclamos(Request $req){
        
        $isValidate = ($req->codBoleta) ;
        $isValidate2 = isNullEmpty($req->fecha);
        

        
        if($isValidate == null ) {
            //"SELECT * FROM  boleta WHERE codigoboleta = '{$req->codBoleta}' OR fecha ='{$req->fecha}'"
           
        }
       
    }

}

