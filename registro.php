<?php require_once("views/cabecera.php");?>
        <!-- Divisor del contenido -->
         <div id="contenido">
            <h1>Bienvenidos a Car Slot Collection</h1>
            <h2>Nuevo Usuario</h2>
            <form id="nuevoUsuario" action="userController.php" method="post">
                <label for="nombreUsuario">Nombre</label><br>
                <input type="text" id="nombreUsuario" name="nombreUsuario"><br>

                <label for="apellidosUsuario">Apellidos</label><br>
                <input type="text" id="apellidosUsuario" name="apellidosUsuario"><br>

                <label for="email">Email</label><br>
                <input type="text" id="email" name="email"><br>

                <label for="contraseña">Contraseña</label><br>
                <input type="password" id="contraseña" name="contraseña"><br>

                <input type="submit"  onclick ="return enviarFormulario()"   value ="Registrarse"><!--a donde mandamos esto?-->
                <input type="button" value ="Ya estoy registrado">
            </form>
            <div id="error" style="color:red;" ></div>
        </div> 
         <?php require_once("views/pieDePagina.php");?>
    </body>
    <script src="js/users.js"></script>
</html>