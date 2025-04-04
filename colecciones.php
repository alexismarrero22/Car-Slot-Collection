<?php require_once("views/cabecera.php"); ?>
<h1>Coleccionistas</h1>
<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Colección</th>
    </tr>
    <?php
        require_once("controllers/userController.php");
        userController::showUsers();
    ?>
</table>
<script src="js/users.js"></script>
<?php require_once("views/pieDePagina.php"); ?>