<head>
    <title>Inicio Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/inicioSesion.css">
</head>

<body>
    <div id="logo">
        <img src="img/logo.png" alt="Car Slot Collection">
    </div><br>
    <form id="usuarioRegistrado" action="controllers/userController.php?action=check" method="post">
        <label for="emailUsuario">Email</label><br>
        <input type="text" id="emailUsuario" name="emailUsuario"><br><br>

        <label for="password">Contraseña</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>