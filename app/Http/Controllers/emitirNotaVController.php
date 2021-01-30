<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class emitirNotaVController extends Controller
{
    function usuarioNV (Request $req){
    $isValidate = isNullEmpty($req->usuario);

    if($isValidate){
        return $isValidate;
    }

    return mySQLConsulta("SELECT nombres, apellidos,codigo FROM  usuarios WHERE usuario='{$req->usuario}'");
    }
    
    //BUSCAR PRODUCTOS
    function ProductosL (Request $req){
    $isValidate = isNullEmpty($req->nombreP);
    
    if($isValidate){
        return $isValidate;
    }

    if (strlen($req->nombreP) < 3) return "Ingrese el nombre del producto";
    
    return mySQLConsulta(
        "SELECT p.nombre,
                p.marka AS marca,
                ct.nombre AS categoria,
                p.precio 
                FROM producto p,
                     categoria ct 
                WHERE (p.nombre LIKE'%{$req->nombreP}%') 
                AND p.fk_producto_categoria = ct.id_categoria");
    }
    
    //GUARDAR NOTA DE VENTA FINAL
    function guardarNV (Request $req){

        $TIPO_DNI = 1;
        $TIPO_PASAPORTE = 2;

        $isValidate = isNullEmpty($req->nombre   , 'nombreP'  , 'El campo nombre no puede ser vacio.') ?:
                      isNullEmpty($req->tipoDoc    , 'tipoD'    , 'El campo tipo de documento no puede ser vacio.') ?: 
                      isNullEmpty($req->numDoc  , 'numeroD'  , 'El campo numero de documento no puede ser vacio.') ?: 
                      //isNullEmpty($req->direccion  , 'direccion'  , 'El campo direccion no puede ser vacio.');
                      isNullEmpty($req->celular  ,'celular'   , 'El campo celulaar no puede ser vacio.');
                      isNullEmpty($req->fecha    ,'fecha'     , 'El campo celulaar no puede ser vacio.');
        
         if($isValidate){
           return $isValidate;
        }
   //validación del dni caracteres
        if (strlen($req->numDoc) != 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO 
         return JSON_ENCODE(
         (object) [
                   'status' => $_SESSION["STATUS_CONTROL"],
                   'msj'    => 'Debe tener 8 caracteres sí es un DNI.'
                 ] 
            ); 
        } else if (strlen($req->numDoc) != 12 && $req->tipoDoc == $TIPO_PASAPORTE ) { // CARNET DE PASAPORTE
          return JSON_ENCODE(
          (object) [
                   'status' => $_SESSION["STATUS_CONTROL"],
                   'msj'    => 'Debe tener  16 caracteres sí es un PASAPORTE..'
                 ]
           );
        }
    
        return mySQLInsert(
            "INSERT INTO notadeventas (DOCUMENTOS_id_documentos,USUARIOS_id_usuario,fecha,nombre_cliente,numdocumento_cliente,telefono_cliente,estado,monto) 
            SELECT '{$req->tipoDoc}',id_usuario,'{$req->fecha}','{$req->nombre}', '{$req->numDoc}','{$req->celular}','POR ATENDER','{$req->monto}'
            FROM usuarios 
            WHERE codigo like  '{$req->codigoU}'"
            
            );
        return mySQLInsert(
          " INSERT INTO notadeventas_has_producto (NOTADEVENTAS_id_boletaventa,PRODUCTO_id_producto,cantidad)
            SELECT id_boletaventa,id_producto,3
            FROM notadeventas nv,producto p
            WHERE nv.numdocumento_cliente= '{$req->numDoc}'
            AND   p.nombre= '{$req->nombreP}'"
        );
        
    


    }


}
