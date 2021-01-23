<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php';

class gestionarUsuarioController extends Controller
{
   

   
   function listaUsuario (Request $req){

            return mySQLConsulta("SELECT * FROM usuarios WHERE estado='A' LIMIT 0,50");
    }

    function getBuscarUsuario (Request $req){

        $isValidate = isNullEmpty($req->nombre);
        //$isValidate2= isNullEmpty($req->apellido);
        if($isValidate){
            return $isValidate;
        }

       return mySQLConsulta("SELECT u.nombres,u.apellido,u.num_documento,r.nombre FROM usuarios u , rol r
        WHERE u.rol_id_rol = r.id_rol AND (u.nombres LIKE '{$req->nombre}%' OR u.apellido LIKE '{$req->nombre}%') LIMIT 0,50");
          
    }

    function crearUsuario (Request $req){
        //usuario = numero dni

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
                            isNullEmpty($req->telefono,'telefono');
                            isNullEmpty($req->fechaInicio,'fechaInicio');

        if($ValidacionCampos){
            return $ValidacionCampos;
        }
      
        if (count($req->contrasenia) < 5) {
                return JSON_ENCODE(
                    (object) [
                        'status' => $_SESSION["STATUS_CONTROL"],
                        'msj'    => 'La contraseña debe tener minimo 5 caracteres.'
                    ]
                ); 
        }

        if (count($req->numDoc) < 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO 
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La contraseña debe tener minimo 8 caracteres sí es un DNI.'
                ]
            ); 
        } else if (count($req->numDoc) < 16 && $req->tipoDoc == $TIPO_PASAPORTE ) { // CARNET DE PASAPORTE
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La contraseña debe tener minimo 16 caracteres sí es un PASAPORTE..'
                ]
            );
        }

      $usuario = mySQLConsulta("SELECT * FROM usuarios WHERE num_documento = '{$req->numDoc}' /*AND estado ='A'*/");
      echo "USUARIO ---> ".$usuario;
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
          "INSERT INTO usuarios (documentos_id_documentos, rol_id_rol, usuario, contrasenia, nombres, apellido, num_documento, direccion, telefono, /*estado*/, fechaInicio) 
                         VALUES ('{$req->tipoDoc}', '{$req->rol}', '{$req->usuario}', '{$req->contrasenia}','{$req->nombres}', '{$req->apellido}','{$req->numDoc}', '{$req->direccion}', '{$req->telefono}',/*'{$req->estado}',*/ '{$req->fechaInicio}')");
    }

    

}

