<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../app/helper/untils.php';
class gProductosController extends Controller
{
    function listProduct (Request $req){

   return mySQLConsulta("SELECT nombre, marka,precio,stock,imagen FROM producto WHERE estado =1 ");
    }
}
