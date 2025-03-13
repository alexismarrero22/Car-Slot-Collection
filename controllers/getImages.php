<?php
    require_once "../models/accessbbdd.php";
    require_once "../models/databaseConn.php";

    $conexion = new Database();

    $sql = "SELECT decoration FROM Cars"; //buscamos las decoraciones de la tabla coches
    $result = $conexion->query($sql);

    $imagenes = []; //creamos un array para guardar las pintadas
    
    if($result && $result->num_rows > 0){
        while($fila = $result->fetch_assoc()){
            $imagenes[] = $fila["decoration"]; //guardamos las rutas de las pintadas
        }
    }
    header('Content-Type: application/json');
    
    echo json_encode($imagenes); //devolvemos los datos en formato json


?>