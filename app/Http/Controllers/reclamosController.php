<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{
    function getReclamos(Request $req){
 
        
        $isValidate = (isNullEmpty($req->codBoleta) != null) && (isNullEmpty($req->nombre) != null) && (isNullEmpty($req->documento) != null) && (isNullEmpty($req->fecha) != null);
        
        if ($isValidate == 1) {
            return JSON_ENCODE(
                (object) [
                    'status' => 1,
                    'msj'    => 'Al menos un campo debe estar lleno para realizar la busqueda'
                 ]
                );
            // termino la consulta 
        }
    
        return mySQLConsulta(
            "SELECT b.codigo_boleta,
                    nv.id_boletaventa,
                    nv.nombre_cliente,
                    d.nombre AS documento,
                    b.fecha,
                    (SELECT CONCAT(
                            '[', 
                                GROUP_CONCAT(
                                JSON_OBJECT('cantidad', nvp.cantidad,
                                            'producto', p.nombre,
                                            'precio', p.precio
                                )
                                ),
                            ']'
                            ) 
                    FROM NOTADEVENTAS_has_PRODUCTO nvp,
                            PRODUCTO p, 
                            CATEGORIA c
                    WHERE nvp.NOTADEVENTAS_id_boletaventa = 1
                        AND nvp.PRODUCTO_id_producto = p.id_producto
                        AND p.CATEGORIA_id_categoria = c.id_categoria
                    ) AS productos
            FROM BOLETA       AS b,
                    NOTADEVENTAS AS nv,
                    DOCUMENTOS d
            WHERE (CASE WHEN '{$req->codBoleta}' IS NOT NULL AND '{$req->codBoleta}' <> ''
                        THEN b.codigo_boleta = '{$req->codBoleta}' AND b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa
                        ELSE 1 = 1
                        END
                    )
                AND (CASE WHEN '{$req->nombre}' IS NOT NULL AND '{$req->nombre}' <> ''
                        THEN nv.nombre_cliente = '{$req->nombre}'
                        ELSE 1 = 1
                        END
                    )
                AND (CASE WHEN '{$req->documento}' IS NOT NULL AND '{$req->documento}' <> '' 
                        THEN nv.numdocumento_cliente = '{$req->documento}'
                        ELSE 1 = 1
                        END
                    )
                AND (CASE WHEN '{$req->fecha}' IS NOT NULL AND '{$req->fecha}' <> '' 
                        THEN b.fecha = '{$req->fecha}'
                        ELSE 1 = 1
                        END
                    )
                AND nv.DOCUMENTOS_id_documentos = d.id_documentos;  
        "
        );
    }
    
    function postRegistrar(Request $req){

        $isValidate = isNullEmpty($req->descripcion, 'descripcion', 'El campo descripcion no puede ser vacio.') ?:
                      isNullEmpty($req->BOLETA_idB_boleta  , 'codBoleta'  , 'El campo codigo de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->fecha  , 'fecha'  , 'El campo fecha de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->solucion   , 'solucion'   , 'El campo solucion no puede ser vacio.'   );
        
        if ($isValidate){
            return  $isValidate;
        }
        
        return mySQLInsert(
            "INSERT INTO reclamo (descripcion,solucion,BOLETA_idB_boleta) 
                VALUES ('{$req->descripcion}','{$req->solucion}', '{$req->BOLETA_idB_boleta}')",
            "SE REGISTRO EL RECLAMO CON EXITO"
        );
    }

}



