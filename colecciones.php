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
<!--Modal para ver la coleccion del usuario que elegimos-->
<div id="modalCoches" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); z-index:1000; justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius: 10px; max-width: 800px; width:90%; position:relative;">
        <button onclick="cerrarModal()" style="position:absolute; top:10px; right:10px;">X</button>
        <h3>Colección del usuario</h3>
        <div id="contenidoCoches"></div>
    </div>
</div>
<script src="js/tablaCoches.js"></script>