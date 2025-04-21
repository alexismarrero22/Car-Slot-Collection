<?php
    session_start();
    require_once __DIR__ . '/controllers/carController.php';

    if (!isset($_SESSION['users_id'])) {
        exit("Usuario no autenticado");
    }

    $carId = $_GET['id_car'] ?? null;
    if (!$carId) {
        exit("ID de coche no proporcionado");
    }

 
    $result = CarController::getCarWithRallyById($carId, $_SESSION['users_id']);
    $datos = $result ? $result->fetch_assoc() : null;
    if(!$datos){
        exit("No se ha encontrado el coche");
    }

?>
<head>
    <title>Editar Coche</title>
    <link rel="stylesheet" type="text/css" href="css/inicioSesion.css">
</head>
<body>
    <div id="logo" >
        <img src="img/logo.png" alt="Car Slot Collection">
    </div><br>
    <form id="actualizarCoche" action="controllers/carController.php?action=update" method="post"
        onsubmit="return enviarFormularioCocheCorregido(event)">
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($datos['id_car']); ?>">
        <input type="hidden" name="rally_id" value="<?php echo htmlspecialchars($datos['id_rally']); ?>">

        <label for="marcaCoche">Marca</label><br>
        <input type="text" id="marcaCoche" name="marcaCoche" value="<?php echo $datos['brand']; ?>"><br>

        <label for="modeloCoche">Modelo</label><br>
        <input type="text" id="modeloCoche" name="modeloCoche" value="<?php echo $datos['model']; ?>"><br>

        <label for="fabricanteCoche">Fabricante</label><br>
        <input type="text" id="fabricanteCoche" name="fabricanteCoche" value="<?php echo $datos['manufacturer']; ?>"><br>

        <label for="nombreRally">Rally</label><br>
        <input type="text" id="nombreRally" name="nombreRally" value="<?php echo $datos['nameRally']; ?>"><br>

        <label for="edicionRally">Edición</label><br>
        <input type="text" id="edicionRally" name="edicionRally" value="<?php echo $datos['edition']; ?>"><br>

        <label for="paisRally">País</label><br>
        <input type="text" id="paisRally" name="paisRally" value="<?php echo $datos['country']; ?>"><br>

        <label for="agnoRally">Año</label><br>
        <input type="text" id="agnoRally" name="agnoRally" value="<?php echo $datos['year']; ?>"><br>

        <div id="error" style="color: red; font-weight: bold; margin-top: 10px;"></div>

        <button type="submit">Actualizar</button>

    </form>
    <script src="js/users.js"></script>
</body>
