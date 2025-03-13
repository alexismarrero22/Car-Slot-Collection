<?php
include "../models/Car.php";
$action = $_GET["action"] ?? "";
//Segun lo que recibamos en el action, hacemos una cosa u otra
switch ($action) {
    case "register":
        CarController::addCar();
        break;
    case "show":
        CarController::showCar();
        break;
}
class CarController
{
    public static function addCar(){
        //recibimos los datos enviados en el formulario y los guardamos en una variable
        $marca = $_POST['marcaCoche'] ?? '';
        $modelo = $_POST['modeloCoche'] ?? '';
        $fabricante = $_POST['fabricanteCoche'] ?? '';
        
        //comprobamos que no esten vacías
        if (empty($marca) || empty($modelo) || empty($fabricante) ) {
            exit;
        }
        //Creamos un nuevo objeto Car, le damos sus propiedades e indicamos la ruta para guardar las imagenes
        $coche = new Car();
        $coche->setBrand($marca);   
        $coche->setModel($modelo);
        $coche->setManufacturer($fabricante);
        //Directorio donde se guardan las imagenes
        $directorio = "../uploads/";
        //Nombre del archivo
        $nombreImagen = basename($_FILES["imagenCoche"]["name"]);
        $rutaImagen = $directorio . $nombreImagen;
        //Mover la imagen al directorio
        if (move_uploaded_file($_FILES["imagenCoche"]["tmp_name"], $rutaImagen)) { //movemos el archivo desde la ruta temporal a la ruta que queremos
            $coche->setDecoration($rutaImagen); //guardamos la ruta de la imagen en el objeto coche
            if ($coche->saveCar()) {
                echo "Coche añadido correctamente";
            } else {
                echo "Error al añadir el coche";
            }
        } else {
            echo "Error al subir la imagen";
        }
        header("Location: ../miColeccion.php");
     
        
    }
    public static function showCar()
    {
        $coche = new Car();
        $datos = $coche->getCars();
        if (is_string($datos)) {
            echo $datos;
        } else {
            //para no meter html en el controlador, creamos una plantilla a parte
            while ($fila = $datos->fetch_assoc()) {
                $plantilla = file_get_contents('carListTemplate.php');
                echo str_replace(
                    ['{id}', '{brand}', '{model}', '{manufacturer}', '{decoration}'],
                    [$fila["id"], $fila["brand"], $fila["model"], $fila["manufacturer"], $fila["decoration"]],
                    $plantilla
                );
            }
        }
    }
}
?>