<?php

namespace App\Http\Controllers;
use App\helper\ValidateAuth;
use Illuminate\Http\Request;

include '../app/helper/untils.php';

class initialController extends Controller
{
    function registrarUsuario(Request $req){    
        
        $idRol = $req->id_rol ?: 3;
 
         $isValidate = isNullEmpty($req->user,'user') ?: isNullEmpty($req->password,'password') ?: isNullEmpty($req->nom_user,'nom_user') ?: isNullEmpty($req->ape_user, 'ape_user')  ;
 
         if($isValidate){
             return $isValidate;
         }
         
         $isValidate = validateConsuta(
             "SELECT TRUE AS result
                FROM usuario
               WHERE usuario = '{$req->dni}'"
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
        try {
            $isValidate = isNullEmpty($req->user, 'user') ?: isNullEmpty($req->password, 'user');
            
            if($isValidate){
                return $isValidate;
            }
            
            $result = mySQLConsulta("SELECT * FROM usuarios WHERE usuario ='{$req->user}' AND contrasenia='{$req->password}'");
            $result = json_decode($result);
           
            $token = ValidateAuth::SignIn($result); 
   
            $result-> {'token'} = $token;
            return json_encode($result);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $e->getMessage();
        }
    }
    
}
