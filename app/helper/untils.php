<?php

include '../app/helper/constanst.php';

    function mySQLConsulta(String $sql, $msj = null ) {
        
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"] , $_SESSION["ROOT"], $_SESSION["PASSWORD"])
                or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"])
                or die ("No se puede seleccionar la base de datos");
            
            $consulta = mysqli_query ( $conexion,$sql);
            
            if(!isNullEmpty($consulta,'resConsulta')){
                $tempArray = array();
                $myArray   = array();

                while ($row = $consulta->fetch_object()) {
                    $tempArray = $row;
                    array_push($myArray, $tempArray);
                }

                if (count($myArray) == 0){
                    $object = (object) [
                        'status' => $_SESSION["STATUS_CONTROL"],
                        'msj'    => $msj ?: "Sin resultados."
                    ];   
                    return json_encode($object);    
                } else if (count($myArray) == 1){
                    $newObject = $myArray[0];
                } else {
                    $newObject = $myArray;
                }
                $object = (object) [
                    'status' => $_SESSION["STATUS_SUCCES"],
                    'data'   => $newObject
                ];   
                
                return json_encode($object);
            } else {
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }

    }

   function mySQLInsert($sql, $msj = null) {      
        // Conectar con el servidor de base de datos
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"], $_SESSION["ROOT"], $_SESSION["PASSWORD"])
            or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"]);
            $consulta = mysqli_query ( $conexion,$sql);

            if(!isNullEmpty($consulta,'resConsulta')){
                $object = (object) [
                    'status' => $_SESSION["STATUS_SUCCES"],
                    'msj'    => $msj ?: "Se registro con exito."
                ];
                return json_encode($object);
            } else {
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }
        
    }

    function isNullEmpty($value, $key = null, $msj = null){
        if($value == null|| $value === 'null' || $value === 'undefine' || empty($value) == 1){            
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => $msj ?: $_SESSION["MSJ_CONTROL"],
                    'key'    => $key,
                    'value'  => $value
                 ]
                );
        }
        return null;
    }

    function validateConsuta($sql){
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"] , $_SESSION["ROOT"], $_SESSION["PASSWORD"])
                or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"])
                or die ("No se puede seleccionar la base de datos");
            
            $consulta = mysqli_query ( $conexion,$sql);
            
            if(!isNullEmpty($consulta,'resConsulta')){
                $tempArray = array();
                $myArray   = array();
                while ($row = $consulta->fetch_object()) {
                    $tempArray = $row;
                    array_push($myArray, $tempArray);
                }
                return count($myArray) > 0;
            } else {
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            return $_SESSION["OBJ_ERROR"];
        }
  
    }
  
    function mySQLProcedure($sql, $msj = null){
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"] , $_SESSION["ROOT"], $_SESSION["PASSWORD"])
                or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"])
                or die ("No se puede seleccionar la base de datos");
            
            $consulta = mysqli_query ( $conexion,$sql);
            
            if(isNullEmpty($consulta,'resConsulta')){
                $object = (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => $msj ?: "Proceso exitoso."
                ];
                return $object;
            }
            mysqli_close ($conexion);     
        }catch (Exception $e) {
            return $_SESSION["OBJ_ERROR"];
        }
  
    }