<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php';

class gestionarUsuarioController extends Controller
{
   
   function listaUsuario (Request $req){

            return mySQLConsulta("SELECT u.nombres,u.apellido,u.num_documento,r.nombre FROM usuarios u , rol r WHERE u.rol_id_rol = r.id_rol AND estado='A' LIMIT 0,50");
            
    }

    function getBuscarUsuario (Request $req){

        $isValidate = isNullEmpty($req->nombre);
        //$isValidate2= isNullEmpty($req->apellido);
        if($isValidate){
            return $isValidate;
        }

        
        if (strlen($req->nombre) < 3) return ;
        return mySQLConsulta("SELECT u.nombres,u.apellido,u.num_documento,r.nombre FROM usuarios u , rol r
        WHERE u.rol_id_rol = r.id_rol AND (u.nombres LIKE '{$req->nombre}%' OR u.apellido LIKE '{$req->nombre}%') LIMIT 0,50");
       
       
    }

    function crearUsuario (Request $req){
        //usuario = numero dni
        //inicializando variables para la validaciones
        $TIPO_DNI = 1;
        $TIPO_PASAPORTE = 2;

        $ValidacionCampos = isNullEmpty($req->numDoc,'numDoc') ?: 
                            isNullEmpty($req->rol,'rol') ?:
                            isNullEmpty($req->usuario,'usuario') ?: 
                            isNullEmpty($req->contrasenia,'contrasenia') ?:
                            isNullEmpty($req->nombres,'nombres') ?:
                            isNullEmpty($req->apellido,'apellido') ?: 
                            isNullEmpty($req->tipoDoc,'tipoDoc') ?:  
                            isNullEmpty($req->direccion,'direccion') ?:  
                            isNullEmpty($req->telefono,'telefono') ?:
                            isNullEmpty($req->fechaInicio,'fechaInicio');

        if($ValidacionCampos){
            return $ValidacionCampos;
        }
      
        //validaciones de campos cantidad 
        if (strlen($req->contrasenia) < 5) {
                return JSON_ENCODE(
                    (object) [
                        'status' => $_SESSION["STATUS_CONTROL"], //status del back
                        'msj'    => 'La contraseña debe tener minimo 5 caracteres.' //
                    ]
                ); 
        }
            //validación del dni caracteres
        if (strlen($req->numDoc) == 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO 
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La contraseña debe tener minimo 8 caracteres sí es un DNI.'
                ]
            ); 
        } else if (strlen($req->numDoc) == 12 && $req->tipoDoc == $TIPO_PASAPORTE ) { // CARNET DE PASAPORTE
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La contraseña debe tener minimo 16 caracteres sí es un PASAPORTE..'
                ]
            );
        }

      $usuario = mySQLConsulta("SELECT * FROM usuarios WHERE num_documento = '{$req->numDoc}' AND estado ='A' ");
      $usuario = json_decode($usuario);

      if ($usuario->status == $_SESSION["STATUS_SUCCES"]) {
          return JSON_ENCODE(
              (object) [
                  'status' => $_SESSION["STATUS_CONTROL"],
                  'msj'    => 'El usuario ya se encuentra registrado.'
               ]
          ); 
      }

      return mySQLInsert(
          "INSERT INTO usuarios (documentos_id_documentos, rol_id_rol, usuario, contrasenia, nombres, apellido, num_documento, direccion, telefono, fechaInicio) 
                         VALUES ('{$req->tipoDoc}', '{$req->rol}', '{$req->usuario}', '{$req->contrasenia}','{$req->nombres}', '{$req->apellido}','{$req->numDoc}', '{$req->direccion}', '{$req->telefono}',/*'A',*/ '{$req->fechaInicio}')");
    }

    function deleteUsuario (Request $req){
           return mySQLDelete("DELETE FROM usuarios WHERE num_documento = '{$req->numDoc}'");
    }

    function modificarUsuario (Request $req){
       
        $TIPO_DNI = 1;

        $ValidacionCampos = isNullEmpty($req->nombre,'nombre') ?: 
                            isNullEmpty($req->apellido,'apellido') ?: 
                            isNullEmpty($req->telefono,'telefono') ?:
                            isNullEmpty($req->rol,'rol') ?:
                            isNullEmpty($req->contrasenia,'contraseñia') ?:
                            isNullEmpty($req->contrasenia,'numDoc');
                            
                    
        if($ValidacionCampos){
            return $ValidacionCampos;}

        // validacion de doc = 8

        if (strlen($req->numDoc) == 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO 
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La contraseña debe tener minimo 8 caracteres sí es un DNI.'
                ]
            ); 
           
        return mySQLDelete("UPDATE FROM usuarios SET nombres = '{$req->nombre}', apellido = '{$req->apellidos}', 
        telefono ='{$req->telefono}', rol_id_rol ='{$req->rol}' , contrasenia = '{$req->contrasenia}'
        WHERE num_documento = '{$req->numDoc}'");
 }

}
}

