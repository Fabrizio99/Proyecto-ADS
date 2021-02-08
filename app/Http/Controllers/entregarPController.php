<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class entregarPController extends Controller
{
    //LISTA BOLETAS
    function listaB (Request $req){
    
        return mySQLConsulta(
            "SELECT b.idB_boleta,
                    nv.nombre_cliente,
                    b.fecha,
                    b.estado,
                    b.monto,
                    b.codigo_boleta,
                    b.telefono_yape,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'codigoP' , p.id_producto,
                                            'nom_prod', p.nombre,
                                            'cantidad', nhp.cantidad,
                                            'precio'  , p.precio,
                                            'monto_x_cantidad', (p.precio*nhp.cantidad)
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
                 FROM notadeventas AS nv ,
                      usuarios AS u,
                      boleta b
                WHERE u.id_usuario = nv.USUARIOS_id_usuario
                  AND nv.id_boletaventa = b.NOTADEVENTAS_id_boletaventa
                  AND b.estado = 'NOATENDIDO'
                ORDER BY b.fecha DESC 
                LIMIT 50          
            "
        );
    }

    function buscarBoletaF(Request $req){

        $isValidate = isNullEmpty($req ->cod_boleta ,'cod_boleta', 'El CODIGO BOLETA estado no puede ser vacio.');

        if($isValidate){
            return $isValidate;
        }

        return mySQLConsulta(
            "SELECT b.idB_boleta,
                    nv.nombre_cliente,
                    b.fecha,
                    b.estado,
                    b.monto,
                    b.codigo_boleta,
                    b.telefono_yape,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'codigoP' , p.id_producto,
                                            'nom_prod', p.nombre,
                                            'cantidad', nhp.cantidad,
                                            'precio'  , p.precio,
                                            'monto_x_cantidad', (p.precio*nhp.cantidad) 
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
               FROM notadeventas AS nv,
                    usuarios AS u,
                    boleta AS b
              WHERE nv.id_boletaventa = b.NOTADEVENTAS_id_boletaventa
                AND u.id_usuario    = nv.USUARIOS_id_usuario 
                AND b.codigo_boleta = '{$req->cod_boleta}'
                AND b.estado = 'NOATENDIDO' 
              ORDER BY b.fecha DESC 
              LIMIT 50          
            "
                
        );

    }
    //MODIFICAR ESTADO DE BOLETA
    function modificarEb(Request $req){
        $isValidate = isNullEmpty($req ->id_bv);

        if($isValidate){
            return $isValidate;
        }

        return mySQLInsert(
            "UPDATE boleta
                SET estado = 'ATENDIDO'
              WHERE idB_boleta ='{$req->id_bv}'",
             "MODIFICACION EXITOSA"
            );
    }

}
