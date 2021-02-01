<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class entregarPController extends Controller
{
    //LISTA BOLETAS
    function listaB (Request $req){
    
        return mySQLConsulta(
            "SELECT nv.id_boletaventa,
                    nv.nombre_cliente,
                    nv.fecha,
                    nv.estado,
         
                         (SELECT CONCAT(
                                     '[', 
                                         GROUP_CONCAT(
                                             JSON_OBJECT(
                                                 'imagen', p.imagen,
                                                 'codigoP', p.id_producto,
                                                 'nom_prod', p.nombre,
                                                 'cantidad', nhp.cantidad
                                         )
                                         ),
                                     ']'
                                 ) 
                            FROM notadeventas AS nv2,
                                 notadeventas_has_producto AS nhp,
                                 producto AS p
                           WHERE nv2.id_boletaventa = nv.id_boletaventa
                             AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                             AND p.id_producto      = nhp.PRODUCTO_id_producto
                         ) AS productos
                 FROM notadeventas nv ,
                      usuarios   u
                 WHERE   u.id_usuario    = nv.USUARIOS_id_usuario
                      ORDER BY fecha DESC 
                      LIMIT 50          
            "
                
        );
        
       
    }

    function buscarBoletaF(Request $req){
        return mySQLConsulta(
            "SELECT nv.id_boletaventa,
                    nv.nombre_cliente,
                    nv.fecha,
                    nv.estado,
         
                         (SELECT CONCAT(
                                     '[', 
                                         GROUP_CONCAT(
                                             JSON_OBJECT(
                                                 'imagen', p.imagen,
                                                 'codigoP', p.id_producto,
                                                 'nom_prod', p.nombre,
                                                 'cantidad', nhp.cantidad
                                         )
                                         ),
                                     ']'
                                 ) 
                            FROM notadeventas AS nv2,
                                 notadeventas_has_producto AS nhp,
                                 producto AS p
                           WHERE nv2.id_boletaventa = nv.id_boletaventa
                             AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                             AND p.id_producto     = nhp.PRODUCTO_id_producto
                         ) AS productos
                 FROM notadeventas nv ,
                      usuarios   u
                 WHERE (nv.id_boletaventa = '{$req->cod_boleta}' OR  nv.fecha BETWEEN DATE_FORMAT('{$req->fecha_inicio}', '%Y-%m-%d') AND DATE_FORMAT('{$req->fecha_fin}', '%Y-%m-%d'))
                      AND u.id_usuario    = nv.USUARIOS_id_usuario
                      ORDER BY fecha DESC 
                      LIMIT 50          
            "
                
        );

    }
    //MODIFICAR ESTADO DE BOLETA
    function modificarEb(Request $req){
        $isValidate = IsNullEmpty($req ->id_bv)?:
                      IsNullEmpty($req ->estado ,'estado', 'El campo estado no puede ser vacio.');



if($isValidate){
return $isValidate;
}
        return mySQLInsert(
            "UPDATE
            notadeventas
            INNER JOIN
            boleta
            ON
            notadeventas.id_boletaventa  = boleta.NOTADEVENTAS_id_boletaventa
            SET
            boleta.estado = '{$req->estado}', notadeventas.estado = '{$req->estado}'
            WHERE
            notadeventas.id_boletaventa ='{$req->id_bv}'",
             "MODIFICACION EXITOSA"
            );
    }

}
