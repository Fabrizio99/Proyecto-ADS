<?php

namespace App\Http\Controllers;
use App\helper\ValidateAuth;
use Illuminate\Http\Request;


include '../app/helper/untils.php';

class initialController extends Controller
{
     
    function getLogin(Request $req){
        try {
            $isValidate = isNullEmpty($req->user, 'user') ?: isNullEmpty($req->password, 'password');
            
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
