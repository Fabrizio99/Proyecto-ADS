<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php';

class initialController extends Controller
{
    function registrarUsuario(Request $req){    
        // Conectar con el servidor de base de datos
         $idRol = $req->id_rol ?: 3;
 
         $isValidate = isNullEmpty($req->user,'user') ?: isNullEmpty($req->password,'password') ?: isNullEmpty($req->nom_user,'nom_user') ?: isNullEmpty($req->ape_user, 'ape_user')  ;
 
         if($isValidate){
             return $isValidate;
         }
         
         $isValidate = validateConsuta(
             "SELECT TRUE AS result
                FROM usuario
               WHERE usuario = '{$req->user}'"
         );
 
         if($isValidate == true){
             $object = (object) [
                 'status' => $_SESSION["STATUS_CONTROL"],
                 'msj'    => "El usuario ya se encuentre registrado."
             ];
             return json_encode($object);
         }
 
         return mySQLInsert("INSERT INTO usuario (usuario,contraseña,nomb_usuario,ape_usuario,_id_rol) 
         VALUES ('{$req->user}','{$req->password}','{$req->nom_user}','{$req->ape_user}',3 )");
    }
     
    function getLogin(Request $req){
        //echo "LLEGO ESTO ".$$req->user ;
        //echo "LLEGO ESTO ".$$req->password ;

         $isValidate = isNullEmpty($req->user, 'user') ?: isNullEmpty($req->password, 'user');
         if($isValidate){
             return $isValidate;
         }
         
         return mySQLConsulta("SELECT * FROM usuarios WHERE usuario ='{$req->user}' AND contraseña='{$req->password}'");
         //debo guardarlo en el storage para consultar sise logeo
    }
    
}
