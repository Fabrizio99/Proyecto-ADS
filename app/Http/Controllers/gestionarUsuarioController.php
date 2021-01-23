<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php';

class gestionarUsuarioController extends Controller
{
    function getListarUsuarios (){
       // return mySQLConsulta("SELECT * FROM usuarios WHERE estado='A' LIMIT 0,50");
    } 

    function getBuscarUsuario (Request $req){

        $isValidate = isNullEmpty($req->nombre);
        //$isValidate2= isNullEmpty($req->apellido);
        if($isValidate){
            return $isValidate;
        }/*else if($isValidate2) {
            return $isValidate2;
        }*/
            return mySQLConsulta("SELECT u.nombres,u.apellido,u.num_documento,r.nombre FROM usuarios u , rol r
            WHERE u.rol_id_rol = r.id_rol AND (u.nombres LIKE '{$req->nombre}%' OR u.apellido LIKE '{$req->nombre}%') LIMIT 0,50");
            
        
    }
}
