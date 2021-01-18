<?php

include '../app/helper/constanst.php';

    function mySQLConsulta(String $sql) {
        
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
                        'msj'    => "Sin resultados."
                    ];   
                    return json_encode($object);    
                }
                $newObject = json_encode($myArray);
                return $newObject;
            } else {
                echo "Fallo en la consulta: REVISA TUS PTAS CONSTANTES ANIMAL DE MRD   ---- servidor>app>helper>constants".$sql."<br>".mysqli_error($conexion);
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }

    }

   function mySQLInsert($sql) {      
        // Conectar con el servidor de base de datos
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"], $_SESSION["ROOT"], $_SESSION["PASSWORD"])
            or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"]);
            $consulta = mysqli_query ( $conexion,$sql);

            if(!isNullEmpty($consulta,'resConsulta')){
                $object = (object) [
                    'status' => $_SESSION["STATUS_SUCCES"],
                    'msj'    => "Se registro con exito."
                ];
                return json_encode($object);
            } else {
                echo "Fallo en la consulta: REVISA TUS PTAS CONSTANTES ANIMAL DE MRD " . $sql . "<br>" . mysqli_error($conexion)."<br>".$consulta;
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }
        
    }

    function isNullEmpty($msj, $key = null){
        if($msj == null|| $msj === 'null' || $msj === 'undefine' || empty($msj) == 1){            
            return JSON_ENCODE(
                (object) [
                    'status' => $_SESSION["STATUS_CONTROL"],
                    'msj'    => $_SESSION["MSJ_CONTROL"],
                    'key'    => $key,
                    'value'  => $msj
                 ]
                );

            // return $_SESSION["OBJ_CONTROL"];
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
                echo "Fallo en la consulta: REVISA TUS PTAS CONSTANTES ANIMAL DE MRD   ---- servidor>app>helper>constants".$sql."<br>".mysqli_error($conexion);
                return $_SESSION["OBJ_ERROR"];
            }
            mysqli_close ($conexion);     
        }  catch (Exception $e) {
            echo 'Excepción capturada: REVISA TUS PTAS CONSTANTES ANIMAL DE MRD ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }
  
    }
  
    function mySQLProcedure($sql){
        try {
            $conexion = mysqli_connect ($_SESSION["SERVIDOR"] , $_SESSION["ROOT"], $_SESSION["PASSWORD"])
                or die ("No se puede conectar con el servidor");
        
            mysqli_select_db ($conexion, $_SESSION["DATA_BASE"])
                or die ("No se puede seleccionar la base de datos");
            
            $consulta = mysqli_query ( $conexion,$sql);
            
            if(isNullEmpty($consulta,'resConsulta')){
                echo "Fallo en la consulta: REVISA TUS PTAS CONSTANTES ANIMAL DE MRD   ---- servidor>app>helper>constants".$sql."<br>".mysqli_error($conexion);
                return $_SESSION["OBJ_ERROR"];

            }
            mysqli_close ($conexion);     
        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return $_SESSION["OBJ_ERROR"];
        }
  
    }