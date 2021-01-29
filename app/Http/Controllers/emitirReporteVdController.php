<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class emitirReporteVdController extends Controller
{
    function listaBoletaE (Request $req){
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
AND (CASE WHEN '{$req->fecha}' IS NOT NULL AND '{$req->fecha}' <> ''
         THEN b.fecha = '{$req->fecha}'
         ELSE b.fecha = DATE(NOW())
         END
     ");

    }
    
}
/*
SELEC
	b.idB_boleta AS N,
	b.codigo_boleta AS Codigo,
	nv.nombre_cliente AS NombreCliente,
	p.nombre AS Productos,
	b.monto AS Monto,
	t.tipo AS TipodePago
FROM boleta AS b, 
	notadeventas AS nv ,
	notadeventas_has_producto AS nhp,
	producto AS p,
	tipopago AS t
	
where 
	t.id_tipopago=b.TIPOPAGO_id_tipopago and
	b.NOTADEVENTAS_id_boletaventa=nv.id_boletaventa and
	nv.id_boletaventa=nhp.NOTADEVENTAS_id_boletaventa and
	nhp.PRODUCTO_id_producto=p.id_producto and(
	b.idB_boleta= null or b.fecha='0000-00-00');*/