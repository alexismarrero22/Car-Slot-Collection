<?php
    session_start();
    require_once __DIR__ . '/models/Car.php';

    if (!isset($_SESSION['users_id'])) {
        exit("Usuario no autenticado");
    }

    $carId = $_GET['id_car'] ?? null;
    if (!$carId) {
        exit("ID de coche no proporcionado");
    }

    $coche = new Car();
    $datos = $coche->getCarById($carId, $_SESSION['users_id']);
    if(!$datos){
        exit("No se ha encontrado el coche");
    }

?>
<form action="controllers/carController.php?action=update" method="post">
    <input type="hidden" name="id_car" value="<?php echo $datos['id_car']; ?>">

    <label for="marcaCoche">Marca</label><br>
    <input type="text" id="marcaCoche" name="marcaCoche" value="<?php echo $datos['brand']; ?>"><br>

    <label for="modeloCoche">Modelo</label><br>
    <input type="text" id="modeloCoche" name="modeloCoche" value="<?php echo $datos['model']; ?>"><br>

    <label for="fabricanteCoche">Fabricante</label><br>
    <input type="text" id="fabricanteCoche" name="fabricanteCoche" value="<?php echo $datos['manufacturer']; ?>"><br>

    <button type="submit">Actualizar</button>

</form>