<?php

session_start();
ob_start();

//VALUES OF CONECTION
$_SESSION["ROOT"]         = "root";      //USER DE MYSQL
$_SESSION["PASSWORD"]     = "root";      //PASSWORD DE MYSQL
$_SESSION["SERVIDOR"]     = "localhost"; //SERVIDOR
$_SESSION["DATA_BASE"]    = "pruebita2";  //NOMBRE DE LA BASE DE DATOS // NO PUSHEAR ESTO MRD :V

//STATUS DE PETICIONES
$_SESSION["STATUS_SUCCES"]  = "0";
$_SESSION["STATUS_CONTROL"] = "1";
$_SESSION["STATUS_ERROR"]   = "2";

//MESSAGES RESULT
$_SESSION["MSJ_ERROR"] = "Hubo un error.";
$_SESSION["MSJ_CONTROL"] = "Accion no permitida.";

//OBJ ERROR
$_SESSION["OBJ_ERROR"] = JSON_ENCODE(
            (object) [
                'status' => $_SESSION["STATUS_ERROR"],
                'msj'    => $_SESSION["MSJ_ERROR"]
             ]
            );
//OBJ CONTROL
$_SESSION["OBJ_CONTROL"] = JSON_ENCODE(
    (object) [
        'status' => $_SESSION["STATUS_CONTROL"],
        'msj'    => $_SESSION["MSJ_CONTROL"]
     ]
    ); 
