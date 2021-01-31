<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';

class emitirBvController extends Controller
{
    //---Lista de Notas de Ventas
    function listaNotaV(Request $req){
        
        return mySQLConsulta(
            "SELECT 
            id_boletaventa AS codigo, 
            nombre_cliente AS cliente,
            estado,
            monto                      
            FROM notadeventas 
            LIMIT 0,50"
        );

    }

    //--Busqueda de Notas por fechas y codigo 
    function buscaNotaVByFechas(Request $req){

        $Validacion = (isNullEmpty($req->notaVid) != null) && (isNullEmpty($req->fechaInicio) != null) && 
                      (isNullEmpty($req->fechaFin) != null);
        
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
                    u.fechaInicio AS FechaEmision,
                    nv.nombre_cliente AS Cliente,
                    d.nombre AS tipoDocumento,
                    nv.numdocumento_cliente AS N_Documento,
                    nv.telefono_cliente AS Celular,
                    nv.direccion_cliente AS Direccion,
                    (SELECT CONCAT(
                                '[', 
                                    GROUP_CONCAT(
                                        JSON_OBJECT(
                                            'producto', p.nombre,
                                            'precio'  , p.precio,
                                            'cantidad', nhp.cantidad, 
                                            'PrecioTotal'  , (p.precio * nhp.cantidad)
                                            
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
            WHERE (nv.id_boletaventa = '{$req->notaVid}' OR nv.fecha '{$req->fechaInicio}' BETWEEN  AND '{$req->fechaFin}' )
                AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
                AND u.id_usuario      = nv.USUARIOS_id_usuario"
        );

    }

    //----Angel va supervisar esta Función (TAREA PARA ANGEL )

    function registrarPago(Request $req){

        $TIPO_YAPE = 1;
        $TIPO_EFECTIVO = 2;

         // falta de BD boleta
        ///columna monto , monto recibiso=efectivo
        //alva = file
        //columna numero de cuenta

        $valDiferentes = isNullEmpty($req->montorecibido)?:
                        isNullEmpty($req->vuelto)?:
                        isNullEmpty($req->tipopago)?:
                        isNullEmpty($req->cuenta,'','cuenta')?:
                        isNullEmpty($req->imgPrueba,'','');
        
        $valComun = isNullEmpty($req->montoPagar,'','ps montopagar') ?:
                    isNullEmpty($req->notaIdBv,'','notaventaId') ?: 
                    isNullEmpty($req->fecha,'','fecha') ?:
                    isNullEmpty($req->tipopago,'','tipoPago');
                    //isNullEmpty($req->file,'','file');

        if($valComun){
            return $valComun;
        }else if ($valDiferentes){
            return $valDiferentes;
        }
        
        //Modificación de Productos (Se reduce los productos al registrar una boleta)
        $modificar= mySQLupDate(
            "UPDATE producto AS p,
                    notadeventas_has_producto AS nhp, 
                    notadeventas AS nv 
                SET p.stock=p.stock-nhp.cantidad  
              WHERE p.id_producto = '{$req->idProducto}'
                AND nhp.PRODUCTO_id_producto 
                AND nv.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
                AND nv.id_boletaventa = '{$req->notaIdBv}'"
        ); 
          
          $modificar = json_decode($modificar);
          
          if ($modificar->status <> 0) {
            return JSON_ENCODE(
                (object) [
                    'msj'    => 'No se cambio la cantidad de productos correctamente',
                    'status' => '0'
                 ]
            );  }
              
            
            echo'no funciona';
            if($req->tipopago == 1){
                
                 return mySQLInsert("INSERT INTO boleta  
                 (TIPOPAGO_id_tipopago,
                 NOTADEVENTAS_id_boletaventa,
                 fecha,
                 monto) 
                 VALUES('{$req->tipopago}','{$req->notaIdBv}','{$req->fecha}','{$req->montorecibido}'",'SE REGISTRO EL PAGO POR EFECTIVO');
                 
                }else if($req->tipopago == 2){
                    return mySQLInsert("INSERT INTO boleta  
                    (TIPOPAGO_id_tipopago,
                    NOTADEVENTAS_id_boletaventa,
                    fecha,
                     telefono_yape,
                      monto) 
                       VALUES('{$req->tipopago}','{$req->notaIdBv}',
                       '{$req->fecha}','{$req->telefonoYape}',
                       '{$req->montorecibido}')",'SE REGISTRO EL PAGO POR YAPE');
        }  
    
    } 
}



   



