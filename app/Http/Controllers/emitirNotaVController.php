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

        $isValidate = isNullEmpty($req->nombre    , 'nombreP'   , 'Verificar campos.') ?:
                      isNullEmpty($req->tipoDoc   , 'tipoD'     , 'Verificar campos.') ?: 
                      isNullEmpty($req->numDoc    , 'numeroD'   , 'Verificar campos.') ?: 
                      isNullEmpty($req->direccion , 'direccion' , 'Verificar campos.') ?: 
                      isNullEmpty($req->celular   , 'celular'   , 'Verificar campos.') ?: 
                      isNullEmpty($req->monto     , 'monto'     , 'Verificar campos.') ?: 
                      isNullEmpty($req->fecha     , 'fecha'     , 'Verificar campos.');
        
         if($isValidate){
           return $isValidate;
        }
   //validación del dni caracteres
        if (strlen($req->numDoc) != 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO 
         return JSON_ENCODE(
         (object) [
                   'status' => $_SESSION["STATUS_CONTROL"],
                   'msj'    => 'Verificar campos.'
                 ] 
            ); 
        } else if (strlen($req->numDoc) != 12 && $req->tipoDoc == $TIPO_PASAPORTE ) { // CARNET DE PASAPORTE
          return JSON_ENCODE(
          (object) [
                   'status' => $_SESSION["STATUS_CONTROL"],
                   'msj'    => 'Verificar campos.'
                 ]
           );
        }
        
        $req->listProduct = json_decode($req->listProduct);

        if (!$req->listProduct || count($req->listProduct) == 0 ) {
            return JSON_ENCODE(
                (object) [
                         'status' => $_SESSION["STATUS_CONTROL"],
                         'msj'    => 'Verificar campos.'
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
        }

        $nv = mySQLConsulta(
            "SELECT id_boletaventa
               FROM notadeventas
              ORDER BY 1 DESC
              LIMIT 1"
        );

        $nv = json_decode($nv);

        return JSON_ENCODE(
            (object) [
                     'status' => $_SESSION["STATUS_SUCCES"],
                     'msj'    => 'EXITO AL REGISTRAR - N° BOLETA '.$nv->data->id_boletaventa
                     ]
             );
    }

    function eliminarNV(Request $req) {
        $validacion = isNullEmpty($req->notaIdBv,'','Verificar campos.') ;

        if($validacion){
            return $validacion;
        }

        return $modificar= mySQLupDate(
            "UPDATE notadeventas AS nv 
                SET nv.estado = 'ELIMINADO'
                WHERE nv.id_boletaventa = '{$req->notaIdBv}'",
            "Se elimino la nota de ventas correctamente."
        ); 
    }

    function updateNV(Request $req) {
        
        $TIPO_DNI = 1;
        $TIPO_PASAPORTE = 2;
        
        $validacion = isNullEmpty($req->nombre    , 'nombreP'  , 'Verificar campos.') ?:
                      isNullEmpty($req->tipoDoc   , 'tipoD'    , 'Verificar campos.') ?: 
                      isNullEmpty($req->numDoc    , 'numeroD'  , 'Verificar campos.') ?: 
                      isNullEmpty($req->direccion , 'direccion', 'Verificar campos.')?: 
                      isNullEmpty($req->celular   , 'celular'  , 'Verificar campos.');

        if($validacion){
            return $validacion;
        }
        
        //validación del dni caracteres
        if (strlen($req->numDoc) != 8 && $req->tipoDoc == $TIPO_DNI ) { // TIPO     
            return JSON_ENCODE(
                (object) [
                        'status' => $_SESSION["STATUS_CONTROL"],
                        'msj'    => 'Verificar campos.'
                        ] 
                    ); 
        } else if (strlen($req->numDoc) != 12 && $req->tipoDoc == $TIPO_PASAPORTE ) { // CARNET DE PASAPORTE
            return JSON_ENCODE(
                (object) [
                        'status' => $_SESSION["STATUS_CONTROL"],
                        'msj'    => 'Verificar campos.'
                        ]
                );
        }
        
        $req->listProduct = json_decode($req->listProduct);

        if (!$req->listProduct || count($req->listProduct) == 0 ) {
            return JSON_ENCODE(
                (object) [
                        'status' => $_SESSION["STATUS_CONTROL"],
                        'msj'    => 'Verificar campos.'
                    ]
                );
        }  

        mySQLupDate(
            "UPDATE notadeventas 
                SET DOCUMENTOS_id_documentos = '{$req->tipoDoc}',
                    nombre_cliente = '{$req->nombre}',
                    numdocumento_cliente = '{$req->numDoc}',
                    telefono_cliente = '{$req->celular}',
                    estado = 'POR ATENDER',
                    monto  = '{$req->monto}' ,
                    direccion_cliente = '{$req->direccion}'
              WHERE id_boletaventa = '{$req->notaIdBv}'"
        ); 

        mySQLDelete("DELETE FROM notadeventas_has_producto WHERE NOTADEVENTAS_id_boletaventa = '{$req->notaIdBv}'");

        foreach ($req->listProduct as &$valor) {


            mySQLInsert(
                " INSERT INTO notadeventas_has_producto (NOTADEVENTAS_id_boletaventa,PRODUCTO_id_producto,cantidad)
                    VALUES ('{$req->notaIdBv}','{$valor->id_producto}', '{$valor->cantidad}');
                "
            );

            // AQUI HACES TU UPDATE DE CANTIDAD DE STOCK   '{$valor->id_producto}', '{$valor->cantidad}'

        }
        return JSON_ENCODE(
            (object) [
                    'status' => $_SESSION["STATUS_SUCCES"],
                    'msj'    => 'SE MODIFICO LOS ELEMENTOS CON EXITO.'
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