<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';

class emitirReporteVdController extends Controller
{

    //---Lista de Boletas de Ventas
    function listaBoletaE (Request $req){

    return mySQLConsulta(
      "SELECT b.idB_boleta AS N,
              b.idB_boleta AS Codigo,
              nv.nombre_cliente AS NombreCliente,
              b.monto AS Monto,
              t.tipo AS TipodePago
         FROM boleta AS b, 
              notadeventas AS nv ,
              tipopago AS t
        WHERE t.id_tipopago = b.TIPOPAGO_id_tipopago
          AND b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa
          ");

    }

    ///----cumple para btn filtro x fecha de boleta de venta  
    // cumple para btn emitir boleta de venta 
    function emitirRBVbyFecha (Request $req){
         
      return mySQLConsulta(
          "SELECT b.idB_boleta AS N,
                  b.idB_boleta AS Codigo,
                  nv.nombre_cliente AS NombreCliente,
                  b.monto AS Monto,
                  t.tipo AS TipodePago
              FROM boleta AS b, 
                  notadeventas AS nv ,
                  tipopago AS t
            WHERE t.id_tipopago = b.TIPOPAGO_id_tipopago
              AND b.NOTADEVENTAS_id_boletaventa = nv.id_boletaventa
              AND (CASE WHEN '{$req->fecha}' IS NOT NULL AND  '{$req->fecha}' <> ''
                        THEN b.fecha = DATE_FORMAT('{$req->fecha}', '%Y-%m-%d')
                        ELSE b.fecha = DATE_FORMAT(NOW(), '%Y-%m-%d')
                        END)"
      );                  
    }

    //---insert de incidecia 
    function guardarIncidencia (Request $req){
        
        $validacionI = isNullEmpty($req->emisor,'','emisor')?:
                      isNullEmpty($req->receptor,'','receptor')?:
                      isNullEmpty($req->mensaje,'','FALTA incidencia');

                      if($validacionI){
                        return $validacionI;
                      }

                      return mySQLInsert("INSERT INTO reporte (incidencia) VALUES ('{$req->mensaje}')");

                    }


    /// SE REQUIERE DE LA TABLA REPORTEVENTA
    function emitirReporteVenta (Request $req){

        $validacionI = isNullEmpty($req->descripcion,'','la descripcion');

                      if($validacionI){
                        return $validacionI;
                      }

                      return mySQLInsert("SELECT insert into reporte (incidencia,fecha) values ('YA QUIERO MIMIR',sysdate()");
                    }

    }
    


