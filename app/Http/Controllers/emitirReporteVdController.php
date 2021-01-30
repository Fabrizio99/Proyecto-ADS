<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';

class emitirReporteVdController extends Controller
{

    //---Lista de Boletas de Ventas
    function listaBoletaE (Request $req){

    return mySQLConsulta("SELECT b.idB_boleta AS N,
    b.codigo_boleta AS Codigo,
    nv.nombre_cliente AS NombreCliente,
    b.monto AS Monto,
    t.tipo AS TipodePago
    FROM boleta AS b, 
    notadeventas AS nv ,
    tipopago AS t
    WHERE t.id_tipopago = b.TIPOPAGO_id_tipopago
    AND b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa");

    }

    ///----cumple para btn filtro x fecha de boleta de venta  
    // cumple para btn emitir boleta de venta 
    function filtrarBoleta (Request $req){
         
         return mySQLConsulta("SELECT b.idB_boleta AS N,
         b.codigo_boleta AS Codigo,
         nv.nombre_cliente AS NombreCliente,
         b.monto AS Monto,
         t.tipo AS TipodePago
    FROM boleta AS b, 
         notadeventas AS nv ,
         tipopago AS t
   where t.id_tipopago = b.TIPOPAGO_id_tipopago
     and b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa
     AND (CASE WHEN '{$req->fecha}' IS NOT NULL OR '{$req->fecha}' <> ''
              THEN b.fecha = '{$req->fecha}'
              ELSE b.fecha = DATE(NOW())
              END)");
    }

    //SE REQUIERE DE LA TABLA INCIDENCIA
    function guardarIncidencia (Request $req){
        $validacion = isNullEmpty($req->emisor)?:
                      isNullEmpty($req->receptor)?:
                      isNullEmpty($req->incidencia);

        if($validacion){
            return $validacion;
        }

        //Consulta SQL
        return mySQLInsert(
            "INSERT INTO incidencia (emisor,receptor,inicidencia)
            VALUES('{$req->emisor}','{$req->receptor}','{$req->incidencia}')");

    }

    /// SE REQUIERE DE LA TABLA REPORTEVENTA
    function emitirReporteVenta (Request $req){
        return mySQLInsert(
            "INSERT INTO reporteVenta (tipopago,,,,)
            VALUES('{$req->emisor}','{$req->receptor}','{$req->incidencia}')");

    }
    
}

