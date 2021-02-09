<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php';

class gestionarUsuarioController extends Controller
{
    //--------Lista de Usuarios
    function listaUsuario (Request $req){
    //lista de usuarios Activos
    // en la tbl usuarios en la BD falta foto

        return mySQLConsulta(
            "SELECT u.id_usuario,
                    u.documentos_id_documentos AS tipo_doc,
                    u.usuario,
                    u.nombres,
                    u.apellidos,
                    u.num_documento,
                    u.correo,
                    u.telefono,
                    u.estado,
                    u.codigo,
                    u.direccion,
                    u.contrasenia AS clave, 
                    r.id_rol,
                    r.nombre AS Cargo
            FROM usuarios AS u,
                 rol AS r
           WHERE u.rol_id_rol = r.id_rol
             AND r.id_rol
             AND estado ='A' 
           LIMIT 0 ,50"
        );
    }
     

    function cmbTipoDoc (Request $req){
    
        return mySQLConsulta(
            "SELECT *
                FROM documentos"
        );
    }
        

    //-----Buscar Usuario------
    function getBuscarUsuario (Request $req){

        $isValidate = isNullEmpty($req->cmpbusqueda,'cmpbusqueda','Verificar campo vacio.');

        if($isValidate){
            return $isValidate;
        }

        //validacion de tamaño de letras de nombre o apellido
        // if (strlen($req->cmpbusqueda) < 3) return ;
        
        return mySQLConsulta(
            "SELECT u.id_usuario,
                    u.documentos_id_documentos AS tipo_doc,
                    u.usuario,
                    u.nombres,
                    u.apellidos,
                    u.num_documento,
                    u.correo,
                    u.telefono,
                    u.estado,
                    u.codigo,
                    u.direccion,
                    u.contrasenia AS clave,
                    r.id_rol,
                    r.nombre AS Cargo 
               FROM usuarios u , rol r
              WHERE u.rol_id_rol = r.id_rol 
                AND (u.nombres LIKE '{$req->cmpbusqueda}%' OR u.apellidos LIKE '{$req->cmpbusqueda}%') 
                AND estado ='A' 
              LIMIT 0,50"
        );
       
    }
        
    //---Insertar Usuario
    function crearUsuario (Request $req){
       
        $TIPO_DNI = 1;
        $TIPO_PASAPORTE = 2;
        
        $ValidacionCampos = isNullEmpty($req->nombres    ,'nombres'    ,'Verificar campo vacio.') ?:
                            isNullEmpty($req->apellidos  ,'apellidos'  ,'Verificar campo vacio.') ?: 
                            isNullEmpty($req->direccion  ,'direccion'  ,'Verificar campo vacio.') ?:  
                            isNullEmpty($req->telefono   ,'telefono'   ,'Verificar campo vacio.') ?:
                            isNullEmpty($req->rol        ,'rol'        ,'Verificar campo vacio.') ?:
                            isNullEmpty($req->tipoDoc    ,'tipoDoc'    ,'Verificar campo vacio.') ?:
                            isNullEmpty($req->numDoc     ,'numDoc'     ,'Verificar campo vacio.') ?: 
                            isNullEmpty($req->contrasenia,'contrasenia','Verificar campo vacio.');

        if($ValidacionCampos){
            return $ValidacionCampos;
        }

        //validacion de cmpContraseña <5
        if (strlen($req->contrasenia) < 5) {
                return JSON_ENCODE(
                    (object) [
                        'status' => $_SESSION["STATUS_CONTROL"], //status del back
                        'msj'    => 'Verificar campo vacio.' //
                    ]
                ); 
        }

        //validacion de cmpTelefono ==9
        if(strlen($req->telefono) <> 9){
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"], //status del back
                    'msj'    => 'Verificar campo vacio.' //
                ]
            ); 
        }

        //validación del dni caracteres
        if ($req->tipoDoc == $TIPO_DNI && strlen($req->numDoc) <> 8) { // TIPO 
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'Verificar campo vacio.'
                ]
            ); 
        }else if ($req->tipoDoc == $TIPO_PASAPORTE && strlen($req->numDoc) <> 12) { // CARNET DE PASAPORTE
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'Verificar campo vacio.'
                ]
            );
        }
        
        //---Verificación de usuario ya registrado por estado
        $usuario = mySQLConsulta("SELECT * FROM usuarios WHERE num_documento = '{$req->numDoc}' AND estado ='A' ");
        $usuario = json_decode($usuario);
        
        if ($usuario->status == $_SESSION["STATUS_SUCCES"]) {
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'El usuario ya se encuentra registrado.'
                ]
            ); 
            
        } else {
            //se esta insertando el la tbl usuarios en la col usuario = numDoc  
            return mySQLInsert(
                "INSERT INTO usuarios (usuario, nombres, apellidos, direccion, telefono, rol_id_rol, documentos_id_documentos, num_documento, contrasenia, estado) 
                    VALUES ('{$req->numDoc}','{$req->nombres}','{$req->apellidos}', '{$req->direccion}','{$req->telefono}','{$req->rol}', '{$req->tipoDoc}','{$req->numDoc}','{$req->contrasenia}','A')"
            );
        }    
    }
    
    //---Eliminar Usuario
    function deleteUsuario (Request $req){

        $ValidacionCampos = isNullEmpty($req->numDoc,'numDoc','Verificar campo vacio.');
        
        if($ValidacionCampos){
            return $ValidacionCampos;
        }

        return mySQLDelete("UPDATE usuarios SET estado = 'I' WHERE num_documento = '{$req->numDoc}'");
    }

    //---Modificar usuario---------------
    function modificarUsuario (Request $req){
        $TIPO_DNI = 1;
        $TIPO_PASAPORTE = 2;
        $ValidacionCampos = isNullEmpty($req->nombres    , 'nombres'    , 'Verificar campo vacio. ')?: 
                            isNullEmpty($req->apellidos  , 'apellidos'  , 'Verificar campo vacio. ') ?: 
                            isNullEmpty($req->direccion  , 'direccion'  , 'Verificar campo vacio. ') ?:
                            isNullEmpty($req->telefono   , 'telefono'   , 'Verificar campo vacio. ') ?:
                            isNullEmpty($req->rol        , 'rol'        , 'Verificar campo vacio. ') ?:
                            isNullEmpty($req->clave      , 'clave'      , 'Verificar campo vacio. ') ?:
                            isNullEmpty($req->numDoc     , 'numDoc'     , 'Verificar campo vacio. ') ?: 
                            isNullEmpty($req->tipoDoc    , 'tipoDoc'    , 'Verificar campo vacio. ');
                            
        // validaciones de campos            
        if($ValidacionCampos){
            return $ValidacionCampos;
        }

        //validación del cmpTelefono
        if (strlen($req->telefono) <> 9) {
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"], //status del back
                    'msj'    => 'Verificar campo vacio.' //
                ]
            ); 
        }

        //validación del dni caracteres
        if ($req->tipoDoc == $TIPO_DNI && strlen($req->numDoc) <> 8) { // TIPO 
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'Verificar campo vacio.'
                ]
            ); 
        }else if ($req->tipoDoc == $TIPO_PASAPORTE && strlen($req->numDoc) <> 12) { // CARNET DE PASAPORTE
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'Verificar campo vacio.'
                ]
            );
        }
        
        return mySQLUpDate(
            "UPDATE usuarios 
                SET nombres       = '{$req->nombres}', 
                    apellidos     = '{$req->apellidos}', 
                    direccion     = '{$req->direccion}',
                    telefono      = '{$req->telefono}',
                    rol_id_rol    = '{$req->rol}',
                    usuario       = '{$req->numDoc}',
                    num_documento = '{$req->numDoc}',
                    contrasenia   = '{$req->clave}',
                    documentos_id_documentos = '{$req->tipoDoc}'
            WHERE num_documento   = '{$req->numDoc}'"
        );      
    }
    //----Detalle Usuario---------------
    function detalleUsuario (Request $req){

        // detalle de todos los campos del usuario
        return mySQLConsulta(
            "SELECT u.nombres,
                    u.apellidos,
                    u.direccion,
                    u.telefono,
                    r.nombre AS Cargo, 
                    d.nombre AS TipoDocumento,
                    u.usuario AS usuarioDocument,
                    u.contrasenia    
               FROM usuarios AS u,
                    rol AS r,
                    documentos AS d
              WHERE u.rol_id_rol = r.id_rol 
                AND u.documentos_id_documentos = d.id_documentos
                AND u.usuario='{$req->numDoc}'"
        );
    }

}


