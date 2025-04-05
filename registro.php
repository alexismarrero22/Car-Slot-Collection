<?php require_once("views/cabecera.php"); ?>
<!-- Divisor del contenido -->
<div id="contenido">
    <h1>Bienvenidos a Car Slot Collection</h1>
    <h2>Nuevo Usuario</h2>
    <form id="nuevoUsuario" action="controllers/userController.php?action=register" method="post"
        onsubmit="return enviarFormulario(event)">
        <label for="nombreUsuario">Nombre</label><br>
        <input type="text" id="nombreUsuario" name="nombreUsuario"><br>

        <label for="apellidosUsuario">Apellidos</label><br>
        <input type="text" id="apellidosUsuario" name="apellidosUsuario"><br>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br>

        <label for="contrasegna">Contraseña</label><br>
        <input type="password" id="contrasegna" name="contrasegna"><br><br>

        <div id="error" style="color: red; font-weight: bold; margin-top: 10px;"></div>

        <input type="submit" value="Registrarse"><br><br>

    </form>
    <div style="text-align: center;">
        <button onclick="location.href='inicioSesion.php'">Ya estoy registrado</button>
    </div>
    
</div>
<script src="js/users.js"></script>
<?php require_once("views/pieDePagina.php"); ?>