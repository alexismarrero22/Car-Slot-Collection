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

<!--si el usuario no está registrado mostramos esta página-->
<?php if (!isset($_SESSION["users_id"])): ?>

    <body>
        <!-- Divisor de la cabecera -->
        <div id="cabecera">
            <div id="logo">
                <img src="img/logo.png" alt="Car Slot Collection">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="registro.php">Registro</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>

        <!--si esta registrado mostramos esta otra-->
    <?php else: ?>

        <body>
            <!-- Divisor de la cabecera -->
            <div id="cabecera">
                <div id="logo">
                    <img src="img/logo.png" alt="Car Slot Collection">
                </div>

                <nav>
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="miColeccion.php">Mi colección</a></li>
                        <li><a href="colecciones.php">Colecciones</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                        <li><a href="logout.php">Cerrar sesion</a></li>
                    </ul>
                </nav>
            </div>

        <?php endif; ?>