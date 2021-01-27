<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class emitirBvController extends Controller
{
    function lsitaNotaVenta(Request $req){
       
        return mySQLConsulta(
            "SELECT 
            nv.id_boletaventa,
             nv.nombre_cliente,
             b.estado,
             (nvp.cantidad*p.precio)
              FROM notadeventa nv,
              notadeventa_has_producto nvp,
              boleta b,producto p 
               WHERE nvp.cantidad=p.id_producto 
               LIMIT 0,50"
        );

    }
}

