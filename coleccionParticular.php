<?php require_once("views/cabecera.php");
      require_once("controllers/userController.php"); 
    $userId = $_GET['userId'] ?? null;
    if($userId){
        $nombreCompleto = userController::showUserNameByid($userId);
        echo "<h1>Colección de $nombreCompleto</h1>";
    }else{
        echo "<h1>Colección de usuario no especificado</h1>";
    }
?>
      <table>
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fabricante</th>
            <th>Rally</th>
            <th>Edición del rally</th>
            <th>País</th>
            <th>Año</th>
            <th>Decoración</th>
        </tr>
        <?php
         require_once("controllers/carController.php");
         CarController::showCarsById($_GET['userId']);
        ?>
      </table>
      </div>
      <div  id="modalDecoracion" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalDecoracion()">&times;</span>
            <div id="contenidoModalDecoracion"></div>
        </div>
      </div>
      <button onclick="window.location.href='colecciones.php'">← Volver a colecciones</button>

      <script src="js/users.js"></script>