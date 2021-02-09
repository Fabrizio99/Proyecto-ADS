<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';

class emitirBvController extends Controller
{
    //---Lista de Notas de Ventas
    function listaNotaV(Request $req){
        
        return mySQLConsulta(
            "SELECT nv.id_boletaventa AS Codigo,
            u.nombres AS Vendedor,
            nv.fecha AS FechaEmision,
            nv.nombre_cliente AS Cliente,
            d.id_documentos AS tipoDocumento,
            nv.numdocumento_cliente AS N_Documento,
            nv.telefono_cliente AS Celular,
            nv.direccion_cliente AS Direccion,
            nv.estado AS estado,
            (SELECT CONCAT(
                        '[', 
                            GROUP_CONCAT(
                                JSON_OBJECT(
                                    'id_producto', id_producto,
                                    'producto', p.nombre,
                                    'precio'  , p.precio,
                                    'cantidad', nhp.cantidad, 
                                    'PrecioTotal'  , (p.precio * nhp.cantidad),
                                    'stock' ,  p.stock
                                )
                            ),
                        ']'
                    )
            FROM notadeventas AS nv2,
                    notadeventas_has_producto AS nhp,
                    producto AS p
            WHERE nv2.id_boletaventa = nv.id_boletaventa
                AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                AND p.id_producto = nhp.PRODUCTO_id_producto) AS Productos,
                nv.monto AS MontoTotal 
    FROM notadeventas AS nv,
            documentos   AS d,
            usuarios     AS u
    WHERE d.id_documentos   = nv.DOCUMENTOS_id_documentos
      AND u.id_usuario      = nv.USUARIOS_id_usuario
      AND nv.estado = 'POR ATENDER'"
        );

    }


    //--Busqueda de Notas por fechas y codigo 
    function buscaNotaVByFechas(Request $req){
        
        $Validacion = (isNullEmpty($req->notaVid) != null);
        
        //validacion de los cmpsNotaVenta
        if ($Validacion == 1) {
            return JSON_ENCODE(
                (object) [
                    'status' => 1,
                    'msj'    => 'Al menos un campo debe estar lleno para realizar la busqueda'
                 ]
                );
        }

        return mySQLConsulta(
            "SELECT nv.id_boletaventa AS Codigo,
                    u.nombres AS Vendedor,
                    nv.fecha AS FechaEmision,
                    nv.nombre_cliente AS Cliente,
                    d.id_documentos AS tipoDocumento,
                    nv.numdocumento_cliente AS N_Documento,
                    nv.telefono_cliente AS Celular,
                    nv.direccion_cliente AS Direccion,
                    nv.estado AS estado,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'id_producto', id_producto,
                                            'producto', p.nombre,
                                            'precio'  , p.precio,
                                            'cantidad', nhp.cantidad, 
                                            'PrecioTotal'  , (p.precio * nhp.cantidad),
                                            'stock' ,  p.stock
                                        )
                                    ),
                                ']'
                            ) 
                    FROM notadeventas AS nv2,
                            notadeventas_has_producto AS nhp,
                            producto AS p
                    WHERE nv2.id_boletaventa = nv.id_boletaventa
                        AND nv2.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                        AND p.id_producto = nhp.PRODUCTO_id_producto) AS Productos,
                        nv.monto AS MontoTotal 
            FROM notadeventas AS nv,
                    documentos   AS d,
                    usuarios     AS u
            WHERE nv.id_boletaventa = '{$req->notaVid}' 
              AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
              AND u.id_usuario      = nv.USUARIOS_id_usuario
              AND nv.estado = 'POR ATENDER'"
        );

    }

//----Angel va supervisar esta Función (TAREA PARA ANGEL )

function registrarPago(Request $req){
    $TIPO_EFECTIVO = 1;
    $TIPO_YAPE = 2;

    $validacion =   isNullEmpty($req->montoPagar, 'montoPagar', 'El montoPagar no puede estar vacio') ?:
                    isNullEmpty($req->notaIdBv  , 'notaIdBv'  , 'El notaIdBv no puede estar vacio'  ) ?: 
                    isNullEmpty($req->tipopago  , 'tipopago'  , 'El seleccione un tipo de pago'     );
                                        
    //Validacion de cmp Yape y Efectivo
    if($validacion){
        return $validacion;
    }

    // CONVIERTO EL STRING A UNA LISTA DE OBJETOS 
    $req->listProduct = json_decode($req->listProduct);

    // VALIDAR QUE LA LISTA CONTENGA AL MENOS UN ELEMNTO O QUE EXISTA 
    if (!$req->listProduct || count($req->listProduct) == 0 ) {
        return JSON_ENCODE(
            (object) [
                     'status' => $_SESSION["STATUS_CONTROL"],
                     'msj'    => 'Debe tener al menos 1 producto seleccionado.'
                   ]
             );
    } 
     
    if($req->tipopago == $TIPO_EFECTIVO){
        mySQLInsert(
            "INSERT INTO boleta (TIPOPAGO_id_tipopago, NOTADEVENTAS_id_boletaventa, fecha, monto) 
                  VALUES ('{$req->tipopago}','{$req->notaIdBv}',DATE_FORMAT(NOW(), '%Y-%m-%d') ,'{$req->montoPagar}')",'SE REGISTRO EL PAGO POR EFECTIVO');
    } else {

        $validacion = isNullEmpty($req->telefonoYape,'telefonoYape','El telefonoYape no puede estar vacio');
        if($validacion) {
            return $validacion;
        }
    
        mySQLInsert(
            "INSERT INTO boleta (TIPOPAGO_id_tipopago, NOTADEVENTAS_id_boletaventa, fecha, telefono_yape, monto) 
                  VALUES ('{$req->tipopago}','{$req->notaIdBv}', DATE_FORMAT(NOW(), '%Y-%m-%d'),'{$req->telefonoYape}', '{$req->montoPagar}')",'SE REGISTRO EL PAGO POR YAPE');
    }  


    foreach ($req->listProduct as &$valor) {

        //Modificación de Productos (Se reduce los productos al registrar una boleta)

        $modificar = mySQLupDate(
            "UPDATE producto AS p
                SET p.stock  = p.stock - '{$valor->cantidad}',
                    p.estado = (CASE WHEN p.stock - '{$valor->cantidad}' > 0 THEN '1' ELSE '0' END)
              WHERE p.id_producto = '{$valor->id_producto}';"
        ); 
    }

    $modificar = json_decode($modificar);

    mySQLupDate( // CAMBIAR EL ESTADO 
        "UPDATE notadeventas AS nv 
            SET nv.estado = 'ATENDIDO'
        WHERE nv.id_boletaventa = '{$req->notaIdBv}'",
        "Se pago la nota de ventas correctamente."
    ); 
      
    if ($modificar->status <> 0) {
        return JSON_ENCODE(
            (object) [
                'msj'    => 'No se cambio la cantidad de productos correctamente',
                'status' => $modificar->status
                ]
        ); 
    }

    $resultBoleta = mySQLConsulta(
        "SELECT idB_boleta AS N,
                idB_boleta AS Codigo 
           FROM boleta ORDER BY 1 DESC 
          LIMIT 1");

    return JSON_ENCODE(
        (object) [
            'msj'    => 'Se pago correctamente la boleta',
            'status' => 0,
            'id_boleta' => $resultBoleta
        ]
    ); 
} 
}


