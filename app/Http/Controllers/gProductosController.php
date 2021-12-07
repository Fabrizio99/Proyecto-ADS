<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class gProductosController extends Controller
{
    
    function cmbCategoria (Request $req){
        return mySQLConsulta(
            "SELECT *
               FROM categoria"
        );
    }

    function listProduct (Request $req){

        return mySQLConsulta("SELECT p.id_producto,
                                     p.nombre AS nom_prod,
                                     p.marka,
                                     p.precio,
                                     p.stock,
                                     c.nombre,
                                     c.id_categoria
                               FROM producto p,
                                    categoria c
                               WHERE estado = 1
                               AND p.fk_producto_categoria = c.id_categoria"
                            );
    }
    function buscarProduct(Request $req){
        $isValidate = isNullEmpty($req->nombreP);

        if($isValidate){
            return $isValidate;
        }

        return mySQLConsulta(
            "SELECT p.id_producto,
                    P.nombre AS nom_prod,
                    p.stock,
                    p.precio,
                    p.marka , 
                    p.precio ,
                    c.nombre,
                    c.id_categoria
             FROM producto p,
                  categoria c
             WHERE (p.nombre LIKE '%{$req->nombreP}%')
             AND p.fk_producto_categoria = c.id_categoria
             AND estado =1" );
        }

    function deleteP (Request $req){
        $isValidate = isNullEmpty($req->idP);

        if($isValidate){
            return $isValidate;
        }
        
        return mySQLInsert(
            "UPDATE producto 
                SET estado = 0
              WHERE id_producto = '{$req->idP}'",
            "PRODUCTO ELIMINADO EXITOSAMENTE"
        );

    }

    function updateP (Request $req){
        $isValidate = isNullEmpty($req->idP)?:
        isNullEmpty($req->nombre , 'nombreP', 'Verificar campos.') ?:
        isNullEmpty($req->marka  , 'marca'  , 'Verificar campos.') ?: 
        isNullEmpty($req->precio , 'precio' , 'Verificar campos.') ?:
        isNullEmpty($req->id_categoria , 'id_categoria' , 'Verificar campos.') ?:  
        isNullEmpty($req->stock  , 'stock'  , 'Verificar campos.');
        

        if($isValidate){
            return $isValidate;
        }

        return mySQLInsert(
            " UPDATE producto p,categoria c
                 SET p.nombre = '{$req->nombre}', 
                     p.marka = '{$req->marka}', 
                     p.precio = '{$req->precio}', 
                     p.stock = '{$req->stock}',
                     p.fk_producto_categoria = id_categoria
               WHERE id_producto = '{$req->idP}'
                 AND c.id_categoria ='{$req->id_categoria}'"
              ,
             "PRODUCTO MODIFICADO DE FORMA EXITOSA"
        );
    }

    function registrarP (Request $req){
        $isValidate = isNullEmpty($req->nombre , 'nombreP', 'Verificar campos. ') ?:
                      isNullEmpty($req->marka  , 'marca'  , 'Verificar campos. ') ?: 
                      isNullEmpty($req->precio , 'precio' , 'Verificar campos. ') ?: 
                      isNullEmpty($req->id_categoria , 'id_categoria' , 'Verificar campos. ') ?: 
                      isNullEmpty($req->stock  , 'stock'  , 'Verificar campos. ');
                      
        
        if($isValidate){
            return $isValidate;
        }

        return mySQLInsert(
        "INSERT INTO producto (nombre,marka,precio,stock,fk_producto_categoria) 
            VALUES ('{$req->nombre}','{$req->marka}','{$req->precio}','{$req->stock}','{$req->id_categoria}')",
         "PRODUCTO REGISTRADO EXITOSAMENTE"
        );
    }    
}
