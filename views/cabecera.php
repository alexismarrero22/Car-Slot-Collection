<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Car Slot Collection</title>
    <link rel="stylesheet" type="text/css" href="css/carSlotCollection.css">
    <script src="https://kit.fontawesome.com/e8b9164c9d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="cabecera">
        <div id="logo">
            <img src="img/logo.png" alt="Car Slot Collection">
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>

                <?php if (!isset($_SESSION["users_id"])): ?>
                    <li><a href="registro.php">Registro</a></li>
                <?php else: ?>
                    <li><a href="miColeccion.php">Mi colección</a></li>
                    <li><a href="colecciones.php">Colecciones</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                    
                    <?php if (isset($_SESSION["user_rol"]) && $_SESSION["user_rol"] === "admin"): ?>
                        <li><a href="views/adminPanel.php">Administrar</a></li>
                    <?php endif; ?>
                <?php endif; ?>

                
            </ul>
        </nav>
    </div>
</body>
</html>
