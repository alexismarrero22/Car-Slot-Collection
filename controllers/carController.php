<?php
require_once __DIR__ . "/../models/Car.php";
require_once __DIR__ . "/../models/Rally.php";
$action = $_GET["action"] ?? "";
//Segun lo que recibamos en el action, hacemos una cosa u otra
switch ($action) {
    case "register":
        $carId = CarController::addCar(); //añadimos el coche y guardamos su id
        if(is_string($carId)){
            $_SESSION['add_car_mensaje'] = $carId;   
            header("Location: ../miColeccion.php"); 
            break; 
        }
        $addRallyMessage = CarController::addRally($carId); //añadimos el rally si se ha enviado información
        $_SESSION['add_car_mensaje'] = $addRallyMessage; //guardamos el mensaje en la sesión
         header("Location: ../miColeccion.php");
        break;
    case "show":
        CarController::showCar();
        break;
    case "showImages":
        CarController::showImages();
        break;
    case "showMyOwnImages":
        CarController::showMyOwnImages();
        break;
    case "delete":
        CarController::deleteCar();
        break;
    case "update":
        CarController::updateCar();
        break;
    case "showCollection":
        CarController::showCarsById();
        break;
    case "showImagesById":
        if(isset($_GET['id_car'])){
            CarController::showImagesById($_GET['id_car']);
        }
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
        //guardamos el coche y obtenemos su id
        return $coche->saveCar($userId);
       
            
       
        
     
        
    }
    public static function addRally($carId){
      
            //datos del rally
            $nombreRally = $_POST['nombreRally'] ?? '';
            $edicion = $_POST['edicionRAlly'] ?? '';
            $pais = $_POST['paisRally'] ?? '';
            $agno = $_POST['agnoRally'] ?? '';
            //creamos y guardamos el rally si se ha enviado información
            if(!empty($nombreRally) && !empty($edicion) && !empty($pais) && !empty($agno)){
                $rally = new Rally();
                $rally->setName($nombreRally);
                $rally->setEdition($edicion);
                $rally->setCountry($pais);
                $rally->setYear($agno);
                $hasErrorOnSave = $rally->saveRally($carId); //guardamos el rally y mandamos el id del coche para guardar en la tabla carRally
                if($hasErrorOnSave ===null){
                    return  "Coche y rally añadidos correctamente";      
                    
                }

            }
            return "Error al añadir el rally";
           
            
        
          
            
        
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
    public static function showImagesById($id_car){
        $coche = new Car();
        $decoraciones = $coche->getDecorationsById($id_car); //llamamos a la función del modelo que nos devuelve las decoraciones
        foreach ($decoraciones as $decoracion) {
            echo '<img src="data:image/jpeg;base64,' . $decoracion . '" alt="Imagen de coche" style="max-width: 100%; height: auto; margin: 5px;">';
        }
    }
    public static function showMyOwnImages(){
        //primero obtenemos el id del usuario que ha iniciado sesión
        session_start();
        if(!isset($_SESSION['users_id'])){
            exit("Usuario no auntenticado");
        }
        $userId = $_SESSION['users_id'];
        $coche = new Car();
        $decoraciones = $coche->getMyOwnDecorations($userId); //llamamos a la función del modelo que nos devuelve las decoraciones
        foreach ($decoraciones as $decoracion) {
            echo '<img src="data:image/jpeg;base64,' . $decoracion . '" alt="Imagen de coche" style="max-width: 100%; height: auto; margin: 5px;">';
        }
    }

    public static function showMyOwnCars(){
        //primero obtenemos el id del usuario que ha iniciado sesión
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['users_id'])){
            exit("Usuario no auntenticado");
        }
        $userId = $_SESSION['users_id'];
        $coche = new Car();
        $datos = $coche->getMyOwnCars($userId);
        if (is_string($datos)) {
            echo $datos;
        } else {
            //para no meter html en el controlador, creamos una plantilla a parte
            while ($fila = $datos->fetch_assoc()) {
                $plantilla = file_get_contents(__DIR__ . '/carListTemplate.php');
                echo str_replace(
                    ['{id_car}', '{brand}', '{model}', '{manufacturer}', '{id_rally}', '{nameRally}', '{edition}', '{country}', '{year}'],
                    [$fila["id_car"], $fila["brand"], $fila["model"], $fila["manufacturer"], $fila["id_rally"], $fila["nameRally"], $fila["edition"], $fila["country"], $fila["year"]],
                    $plantilla
                );
            }
        }
    }
    public static function deleteCar(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['users_id'])){
            exit("Usuario no auntenticado");
        }
        $carId = $_POST['id_car'] ?? '';
        if(empty($carId)){
            exit("No se ha recibido el id del coche");
        }
        $rallyId = $_POST['id_rally'] ??'';
        if(empty($rallyId) || !is_numeric($rallyId)){
            exit("No se ha recibido el id del rally");
        }
        $coche = new Car();
        $resultado = $coche->deleteCar( $_SESSION['users_id'],$carId);

        $rally = new Rally();
        $resultadoRally = $rally->deleteRally($carId, $rallyId);

        if($resultado && $resultadoRally){
            $_SESSION['delete_car_mensaje'] = "Coche eliminado correctamente";
        }else{
            $_SESSION['delete_car_mensaje'] = "No se pudo eliminar el coche";
        }
        header("Location: ../miColeccion.php");
    }
    public static function updateCar(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['users_id'])){
            exit("Usuario no autenticado");
        }
        $carId = $_POST['car_id'] ?? null;
        $marca = $_POST['marcaCoche'] ?? '';
        $modelo = $_POST['modeloCoche'] ?? '';
        $fabricante = $_POST['fabricanteCoche'] ?? '';

        //datos del rally
        $rallyId = $_POST['rally_id'] ?? null;
        $nombreRally = $_POST['nombreRally'] ?? '';
        $edicionRally = $_POST['edicionRally'] ??'';
        $paisRally = $_POST['paisRally'] ??'';
        $agnoRally = $_POST['agnoRally'] ??'';
        var_dump($_POST);
        
        
        //Actualizar coche
        if (!isset($carId) || !is_numeric($carId) || $carId <= 0 || empty($marca) || empty($modelo) || empty($fabricante)) {
            exit("No se han recibido todos los datos necesarios");
        }
        $coche = new Car();
        $resultado = $coche->updateCar($carId,$_SESSION['users_id'],$marca,$modelo,$fabricante);

        //Actualizar rally
        if(!is_numeric($rallyId)||empty($nombreRally) || empty($edicionRally) || empty($paisRally) || empty($agnoRally)){
            exit("No se han recibido todos los datos necesarios del rally");
        }
        $rally = new Rally();
        $rally->updateRally($rallyId, $nombreRally, $edicionRally, $paisRally, $agnoRally);
        
        if($resultado){
            $_SESSION['update_car_mensaje'] = "Coche actualizado correctamente";
        }else{
            $_SESSION['update_car_mensaje'] = "No se pudo actualizar el coche";
        }
        header("Location: ../miColeccion.php");
    }

    //Mostrar la coleccion de un usuario elegido en colecciones.php
    public static function showCarsById(){
        $userId = $_GET['id_user'] ?? '';
        if(empty($userId) || !is_numeric($userId) || $userId <= 0){
            exit("No se ha recibido el id del usuario");
        }
        $coche = new Car();
        $datos = $coche->getMyOwnCars($userId);
        if (is_string($datos)) {
            echo $datos;
        } else {
            //para no meter html en el controlador, creamos una plantilla a parte
            while ($fila = $datos->fetch_assoc()) {
                $plantilla = file_get_contents(__DIR__ . '/carListTemplateReadOnly.php');
                echo str_replace(
                    ['{id_car}', '{brand}', '{model}', '{manufacturer}'],
                    [$fila["id_car"], $fila["brand"], $fila["model"], $fila["manufacturer"]],
                    $plantilla
                );
            }
        }
    }

    //función para recibir los datos que luego vamos a midifcar
    public static function getCarWithRallyById($carId, $userId){
        $coche = new Car();
        return $coche->getCarWithRally($carId, $userId);
    }
        

    
    
    
}

?>