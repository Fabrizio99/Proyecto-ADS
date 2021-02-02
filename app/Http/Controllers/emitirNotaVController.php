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

        // if (strlen($req->nombreP) < 3) return "Ingrese el nombre del producto";
        
        return mySQLConsulta(
            "SELECT p.nombre,
                    p.id_producto,
                    p.stock,
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
                      isNullEmpty($req->direccion  , 'direccion'  , 'El campo direccion no puede ser vacio.');
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
                   'msj'    => 'Debe tener  12 caracteres sí es un PASAPORTE..'
                 ]
           );
        }
        
        $req->listProduct = json_decode($req->listProduct);

        if (!$req->listProduct || count($req->listProduct) == 0 ) {
            return JSON_ENCODE(
                (object) [
                         'status' => $_SESSION["STATUS_CONTROL"],
                         'msj'    => 'Debe tener al menos 1 producto seleccionado.'
                       ]
                 );
        }  

        mySQLInsert(
            "INSERT INTO notadeventas (DOCUMENTOS_id_documentos,USUARIOS_id_usuario,fecha,nombre_cliente,numdocumento_cliente,telefono_cliente,estado,monto,direccion_cliente) 
            VALUES ( '{$req->tipoDoc}','{$req->idU}', DATE_FORMAT('{$req->fecha}', '%Y-%m-%d') ,'{$req->nombre}', '{$req->numDoc}','{$req->celular}','POR ATENDER','{$req->monto}', '{$req->direccion}')
            "
            );


        foreach ($req->listProduct as &$valor) {

            mySQLInsert(
                " INSERT INTO notadeventas_has_producto (NOTADEVENTAS_id_boletaventa,PRODUCTO_id_producto,cantidad)
                  SELECT id_boletaventa, '{$valor->id_producto}', '{$valor->cantidad}'  
                    FROM notadeventas nv
                    ORDER BY 1 DESC
                    LIMIT 1 
                   "
              );


              // AQUI HACES TU UPDATE DE CANTIDAD DE STOCK   '{$valor->id_producto}', '{$valor->cantidad}'

        }
        return JSON_ENCODE(
            (object) [
                     'status' => $_SESSION["STATUS_SUCCES"],
                     'msj'    => 'EXITO AL REGISTRAR.'
                   ]
             );
    }
}



// PRUEBAAAAAAAAAAAAAAAAAAAAAAAS CON ESTA LISTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA

// listProduct  -->   
// [
//     {
//         "id_producto" : "1",
//         "cantidad" : "5"
//     },
    
//     {
//         "id_producto" : "2",
//         "cantidad" : "4"
//     }
// ]