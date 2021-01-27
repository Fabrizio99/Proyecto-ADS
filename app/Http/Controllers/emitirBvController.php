<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class emitirBvController extends Controller
{
    function lsitaNotaVenta(Request $req){
        return mySQLConsulta(
            "SELECT nv.id_boletaventa,
                    nv.nombre_cliente,
                    nv.telefono_cliente,
                    nv.numdocumento_cliente,
                    nv.fecha,
                    d.nombre AS tipo_doc,
                    u.nombres AS nom_vend,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'nom_prod', p.nombre,
                                            'precio'  , p.precio,
                                            'cantidad', nhp.cantidad, 
                                            'pTotal'  , (p.precio * nhp.cantidad)
                                        )
                                    ),
                                ']'
                            ) 
                       FROM notadeventas AS nv2,
                            notadeventas_has_producto AS nhp,
                            producto AS p
                      WHERE nv2.id_boletaventa = nv.id_boletaventa
                        AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                        AND p.id_producto = nhp.PRODUCTO_id_producto) AS list_productos
               FROM notadeventas AS nv,
                    documentos   AS d,
                    usuarios     AS u
              WHERE nv.id_boletaventa = '{$req->cod_boleta}'
                AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
                AND u.id_usuario      = nv.USUARIOS_id_usuario"
        );

    }
    function lsitaNotaVentaByFecha(Request $req){
        return mySQLConsulta(
            "SELECT nv.id_boletaventa,
                    nv.nombre_cliente,
                    nv.telefono_cliente,
                    nv.numdocumento_cliente,
                    nv.fecha,
                    d.nombre AS tipo_doc,
                    u.nombres AS nom_vend,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'nom_prod', p.nombre,
                                            'precio'  , p.precio,
                                            'cantidad', nhp.cantidad, 
                                            'pTotal'  , (p.precio * nhp.cantidad)
                                        )
                                    ),
                                ']'
                            ) 
                       FROM notadeventas AS nv2,
                            notadeventas_has_producto AS nhp,
                            producto AS p
                      WHERE nv2.id_boletaventa = nv.id_boletaventa
                        AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                        AND p.id_producto = nhp.PRODUCTO_id_producto) AS list_productos
               FROM notadeventas AS nv,
                    documentos   AS d,
                    usuarios     AS u
              WHERE nv.id_boletaventa = '{$req->cod_boleta}'
                AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
                AND u.id_usuario      = nv.USUARIOS_id_usuario
                AND nv.fecha BETWEEN '{$req->fecha_inicio}' AND '{$req->fecha_fin}'
                "
                
        );

    }
}




