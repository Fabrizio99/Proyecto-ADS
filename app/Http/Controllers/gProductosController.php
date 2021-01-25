<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class gProductosController extends Controller
{
    function listProduct (Request $req){

        return mySQLConsulta("SELECT nombre, marka,precio,stock,imagen FROM producto WHERE estado =1 ");
    }

    function deleteP (Request $req){
        $isValidate = isNullEmpty($req->idP);

        if($isValidate){
            return $isValidate;
        }
        
        return mySQLInsert(
        "UPDATE   producto set estado=0  WHERE id_producto ='{$req->idP}'",
        "PRODUCTO ELIMINADO EXITOSAMENTE"
);

    }

    function updateP (Request $req){
        $isValidate = isNullEmpty($req->idP)?:
        isNullEmpty($req->nombre , 'nombreP', 'El campo nombre no puede ser vacio.') ?:
        isNullEmpty($req->marka  , 'marca'  , 'El campo marca de la boleta no puede ser vacio.') ?: 
        isNullEmpty($req->precio , 'precio' , 'El campo precio de la boleta no puede ser vacio.') ?: 
        isNullEmpty($req->stock  , 'stock'  , 'El campo stock no puede ser vacio.');
        isNullEmpty($req->imagen ,'imagen'  , 'El campo imagen no puede ser vacio.');

        if($isValidate){
            return $isValidate;
        }

        return mySQLInsert(
            "UPDATE producto set nombre = '{$req->nombre}', marka = '{$req->marka}', precio = '{$req->precio}', stock = '{$req->stock}' , imagen = '{$req->imagen}' 
            WHERE id_producto = '{$req->idP}'",
             "PRODUCTO MODIFICADO DE FORMA EXITOSA"
            );


    }

    function registrarP (Request $req){
        $isValidate = isNullEmpty($req->nombre , 'nombreP', 'El campo nombre no puede ser vacio.') ?:
                      isNullEmpty($req->marka  , 'marca'  , 'El campo marca de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->precio , 'precio' , 'El campo precio de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->stock  , 'stock'  , 'El campo stock no puede ser vacio.');
                      isNullEmpty($req->imagen ,'imagen'  , 'El campo imagen no puede ser vacio.');
        if($isValidate){
            return $isValidate;
        }

        return mySQLInsert(
        "INSERT INTO producto (nombre,marka,precio,stock,imagen) 
         VALUES ('{$req->nombre}','{$req->marka}', '{$req->precio}','{$req->stock}','{$req->imagen}')",
         "PRODUCTO REGISTRADO EXITOSAMENTE"
        );
    
    
    }

    
}
