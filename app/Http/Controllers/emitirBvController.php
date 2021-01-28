<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';

class emitirBvController extends Controller
{

    function listaNotaV(Request $req){
        
        return mySQLConsulta("SELECT 
        nv.id_boletaventa AS codigo, 
        nv.nombre_cliente AS cliente,
        nv.estado,
        nv.monto                      
        FROM notadeventas AS nv,
        documentos   AS d,
        usuarios     AS u
        WHERE nv.id_boletaventa = '{$req->idboletaV}'
        AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
        AND u.id_usuario      = nv.USUARIOS_id_usuario LIMIT 0,50");

    }

    function buscaNotaVByFechas(Request $req){

        $Validacion = (isNullEmpty($req->notaVid) != null) && (isNullEmpty($req->fechaInicio) != null) && (isNullEmpty($req->fechaFin) != null);
         
        if ($Validacion == 1) {
            return JSON_ENCODE(
                (object) [
                    'status' => 1,
                    'msj'    => 'Al menos un campo debe estar lleno para realizar la busqueda'
                 ]
                );
            // termino la consulta 
        }

        return mySQLConsulta("SELECT nv.id_boletaventa AS Codigo,
        u.nombres AS Vendedor,
        u.fechaInicio AS FechaEmision,
        nv.nombre_cliente AS nombreDeCliente,
        nv.monto AS monto,
        nv.telefono_cliente AS Telefono,
        nv.numdocumento_cliente AS numeroDocumento,
        nv.fecha,
        d.nombre AS tipoDocumento,
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
            AND p.id_producto = nhp.PRODUCTO_id_producto) AS Productos
   FROM notadeventas AS nv,
        documentos   AS d,
        usuarios     AS u
  WHERE (nv.id_boletaventa = '{$req->notaVid}' OR  nv.fecha BETWEEN '{$req->fechaInicio}' AND '{$req->fechaFin}')
    AND d.id_documentos   = nv.DOCUMENTOS_id_documentos
    AND u.id_usuario      = nv.USUARIOS_id_usuario");

    }

    ///////////////////////////////////////////////
    function registrarPago(Request $req){

         // falta de BD boleta
        ///columna monto , monto recibiso=efectivo
        //alva = file
        //columna numero de cuenta

        $val = isNullEmpty($req->montorecibido)?:
                       isNullEmpty($req->vuelto)?:
                       isNullEmpty($req->tipopago)?:
                       isNullEmpty($req->cuenta,'','cuenta')?:
                       isNullEmpty($req->imgPrueba,'','');
        
        $validacion = isNullEmpty($req->montoPagar,'','ps montopagar') ?:
                            isNullEmpty($req->notaIdBv,'','notaventaId') ?: 
                            isNullEmpty($req->fecha,'','fecha') ?:
                            isNullEmpty($req->tipopago,'','tipoPago')?: 
                            isNullEmpty($req->file,'','file');



    
        if($validacion){
            return $validacion;
        }else if ($val){
            return $val;
        }

        $modificar= mySQLupDate(
            "UPDATE producto AS p, notadeventas_has_producto AS nhp, notadeventas AS nv 
            SET p.stock=p.stock-nhp.cantidad  
            WHERE p.id_producto = '{$req->idProducto}'
            AND nhp.PRODUCTO_id_producto 
            AND nv.id_boletaventa = nhp.NOTADEVENTAS_id_boletaventa
            AND nv.id_boletaventa = '{$req->notaIdBv}'"); 
          
          $modificar = json_decode($modificar);

          if ($modificar->status == $_SESSION["STATUS_SUCCES"]) {
              return JSON_ENCODE(
                  (object) [
                      'status' => $_SESSION["STATUS_CONTROL"],
                      'msj'    => 'se cambio la cantidad de productos.'
                   ]
              );        
    }
      
    if(($req->tipopago)==1){
        return("INSERT INTO boleta  
          (TIPOPAGO_id_tipopago,
          NOTADEVENTAS_id_boletaventa,
          fecha,
          monto,
          vuelto) 
          VALUES('{$req->tipopago}','{$req->notaIdBv}','{$req->fecha}','{$req->monto}',{$req->file}");

       }else if(($req->tipopago)==2){
        return("INSERT INTO boleta  (TIPOPAGO_id_tipopago,NOTADEVENTAS_id_boletaventa,fecha,monto,evidencia) 
        VALUES('{$req->tipopago}',
        '{$req->notaIdBv}','{$req->fecha}'
        ,{$req->monto},{$req->imgPrueba},'{$req->cuenta}',{$req->file})");
        }      
    } 

}

   



