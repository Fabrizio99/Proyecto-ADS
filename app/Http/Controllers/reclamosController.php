<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

include '../app/helper/untils.php'; // para cada controller pueda usar las funciones de consulta 

class reclamosController extends Controller
{//buscar boleta
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
            "SELECT b.NOTADEVENTAS_id_boletaventa AS CODIGOB,
            nv.nombre_cliente,
            d.nombre,
            nv.numdocumento_cliente,
            b.fecha,
            (SELECT CONCAT(
                                     '[', 
                                         GROUP_CONCAT(
                                             JSON_OBJECT(
                                                 'producto', p.nombre,
                                                 'precio'  , p.precio,
                                                 'cantidad', nhp.cantidad, 
                                                 'Importe'  , (p.precio * nhp.cantidad)
                                                 
                                             )
                                         ),
                                     ']'
                                 )
                         FROM boleta AS b2,
                                 notadeventas_has_producto AS nhp,
                                 notadeventas AS nv1,
                                 producto AS p
                         WHERE b2.NOTADEVENTAS_id_boletaventa = b.NOTADEVENTAS_id_boletaventa
                           AND    b2.NOTADEVENTAS_id_boletaventa = nv1.id_boletaventa
                             AND b2.NOTADEVENTAS_id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                             AND p.id_producto = nhp.PRODUCTO_id_producto) AS Productos,
            nv.monto AS MontoTotal
     FROM boleta b,
          documentos d,
          notadeventas nv
     WHERE (CASE WHEN '{$req->codBoleta}' IS NOT NULL AND '{$req->codBoleta}' <> ''
                             THEN b.NOTADEVENTAS_id_boletaventa = '{$req->codBoleta}' AND b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa
                             ELSE 1 = 1
                             END
                         )
                     AND (CASE WHEN '{$req->nombre}' IS NOT NULL AND '{$req->nombre}' <> ''
                             THEN nv.nombre_cliente = '{$req->nombre}'
                             ELSE 1 = 1
                             END
                         )
                     AND (CASE WHEN '{$req->documento}'IS NOT NULL AND '{$req->documento}'<> '' 
                             THEN nv.numdocumento_cliente = '{$req->documento}'
                             ELSE 1 = 1
                             END
                         )
                     AND (CASE WHEN '{$req->fecha}' IS NOT NULL AND '{$req->fecha}' <> '' 
                             THEN b.fecha = DATE_FORMAT('{$req->fecha}', '%Y-%m-%d')  
                             ELSE 1 = 1
                             END
                         )
                     AND nv.DOCUMENTOS_id_documentos = d.id_documentos;
        "
        );
    }
    
    function postRegistrar(Request $req){

        $isValidate = isNullEmpty($req->descripcion, 'descripcion', 'El campo descripcion no puede ser vacio.') ?:
                      isNullEmpty($req->codBoleta  , 'codBoleta'  , 'El campo codigo de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->fecha      , 'fecha'      , 'El campo fecha de la boleta no puede ser vacio.') ?: 
                      isNullEmpty($req->solucion   , 'solucion'   , 'El campo solucion no puede ser vacio.'   );
        
        if ($isValidate){
            return  $isValidate;
        }
        
        $boleta = mySQLConsulta("SELECT idB_boleta FROM boleta WHERE NOTADEVENTAS_id_boletaventa = '{$req->codBoleta}'");
        $boleta = json_decode($boleta);

        if ($boleta->status == $_SESSION["STATUS_CONTROL"]) {
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => 'La boleta enviada no esta registrada.'
                 ]
            ); 
        }

        return mySQLInsert(
            "INSERT INTO reclamo (descripcion,solucion,BOLETA_idB_boleta) 
                VALUES ('{$req->descripcion}','{$req->solucion}', '{$boleta->data->idB_boleta}')",
            "SE REGISTRO EL RECLAMO CON EXITO"
        );
    }

}



