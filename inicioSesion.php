<head>
    <title>Inicio Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/inicioSesion.css">
</head>

<body>
    <div id="logo">
        <img src="img/logo.png" alt="Car Slot Collection">
    </div><br>
    <form id="usuarioRegistrado" action="controllers/userController.php?action=check" method="post"
        onsubmit="return enviarformularioUsuarioRegistrado(event)">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br><br>

        <label for="contrasegna">Contraseña</label><br>
        <input type="password" id="contrasegna" name="contrasegna"><br><br>

        <div id="error" style="color: red; font-weight: bold; margin-top: 10px;"></div>

        <input type="submit" value="Entrar">
    </form>
    <script src="js/users.js"></script>
</body>
<?php
session_start();
if (isset($_SESSION['login_message'])) {
    echo "<script>document.getElementById('error').innerHTML = '" . $_SESSION['login_message'] . "';</script>";
    unset($_SESSION['login_message']);
}
?>