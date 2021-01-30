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
            
            $result = mySQLConsulta(
                "SELECT u.id_usuario,
                        u.documentos_id_documentos AS tipo_doc,
                        u.usuario,
                        u.nombres,
                        u.apellidos,
                        u.num_documento,
                        u.correo,
                        u.fechaInicio,
                        u.telefono,
                        u.estado,
                        u.codigo,
                        u.direccion,
                        r.id_rol,
                        r.nombre AS Cargo 
                   FROM usuarios,
                        rol AS r,
                        documentos AS d
                  WHERE usuario ='{$req->user}' 
                    AND contrasenia='{$req->password}'
                    AND u.rol_id_rol = r.id_rol 
                    AND u.documentos_id_documentos = d.id_documentos"
            );
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
