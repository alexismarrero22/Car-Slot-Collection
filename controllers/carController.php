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
        $decoration = $_POST['imagenCoche'] ?? '';
        
        //comprobamos que no esten vacías
        if (empty($marca) || empty($modelo) || empty($fabricante) ) {
            exit;
        }
        //Creamos un nuevo objeto Car, le damos sus propiedades e indicamos la ruta para guardar las imagenes
        $coche = new Car();
        $coche->setBrand($marca);   
        $coche->setModel($modelo);
        $coche->setManufacturer($fabricante);
        //vamos a convertir la imagen en formato binario para poder guardarla en la base de datos
        if(isset($_FILES['imagenCoche'])){
            $imagen = $_FILES['imagenCoche']['tmp_name'];
            $imagen = file_get_contents($imagen);
            $imagen = base64_encode($imagen);
            $coche->setDecoration($imagen);
        }
        //guardamos el coche y redirigimos a la página de la colección
        $coche->saveCar();
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
    public static function showImages(){
        

    }
    
}
?>