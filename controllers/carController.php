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
    case "showImages":
        CarController::showImages();
        break;
}
class CarController
{
    public static function addCar(){
        //primero obtenemos el id del usuario que ha iniciado sesión
        session_start();
        if(!isset($_SESSION['users_id'])){
            exit("Usuario no auntenticado");
        }
        $userId = $_SESSION['users_id'];
        //recibimos los datos enviados en el formulario y los guardamos en una variable
        $marca = $_POST['marcaCoche'] ?? '';
        $modelo = $_POST['modeloCoche'] ?? '';
        $fabricante = $_POST['fabricanteCoche'] ?? '';
        
        //comprobamos que no esten vacías
        if (empty($marca) || empty($modelo) || empty($fabricante) ) {
            exit;
        }
        //Creamos un nuevo objeto Car, le damos sus propiedades ymanejamos las imagenes
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
        if($coche->saveCar($userId)){
            $_SESSION['add_car_mensaje'] = "Coche añadido correctamente";
            
        }else{
            $_SESSION['add_car_mensaje'] = "Error al añadir el coche";
            
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
    public static function showImages(){
        $coche = new Car();
        $decoraciones = $coche->getDecorations(); //llamamos a la función del modelo que nos devuelve las decoraciones
        foreach ($decoraciones as $decoracion) {
            echo '<img src="data:image/jpeg;base64,' . $decoracion . '" alt="Imagen de coche" style="max-width: 100%; height: auto; margin: 5px;">';
        }
    }
        

    
    
    
}
?>