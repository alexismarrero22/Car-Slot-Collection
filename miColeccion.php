<?php require_once("views/cabecera.php"); ?>
<link rel="stylesheet" type="text/css" href="css/carrusel.css">
    <!-- Divisor del contenido -->
     <div>
        <h1>Añadir Coche</h1><br>
        <form id="nuevoCoche" action="controllers/carController.php?action=register" method="post" enctype="multipart/form-data">
            <label for="marcaCoche">Marca</label><br>
            <input type="text" id="marcaCoche" name="marcaCoche"><br>

            <label for="modeloCoche">Modelo</label><br>
            <input type="text" id="modeloCoche" name="modeloCoche"><br>

            <label for="fabricanteCoche">Fabricante</label><br>
            <input type="text" id="fabricanteCoche" name="fabricanteCoche"><br>

            <label for="nombreRally">Rally</label><br>
            <input type="text" id="nombreRally" name="nombreRally"><br>

            <label for="edicionRAlly">Edición</label><br>
            <input type="text" id="edicionRAlly" name="edicionRAlly"><br>

            <label for="paisRally">País</label><br>
            <input type="text" id="paisRally" name="paisRally"><br>

            <label for="agnoRally">Año de celebración</label><br>
            <input type="text" id="agnoRally" name="agnoRally"><br>

            <label for="imagenCoche">Imagen</label><br>
            <input type="file" id="imagenCoche" name="imagenCoche"><br><br>

            

            <input type="submit" value="Añadir"><br><br>
        </form>
     </div>
      <div id="carrusel-container" style="text-align: center;">
         <button id="prev">⬅ Anterior</button>
         <div id="carrusel" style="width: 500px; height: auto; overflow: hidden; display: inline-block;">
            <!-- Aquí se insertarán las imágenes dinámicamente -->
         </div>
         <button id="next">Siguiente ➡</button>
      </div>
      <div id="tablaCoches">
      <h1>Mi Colección</h1><br>
      <table>
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fabricante</th>
            <th>Editar</th>
        </tr>
        <?php
         require_once("controllers/carController.php");
         CarController::showMyOwnCars();
        ?>
      </table>

      </div>
    

     <script src="js/carrusel.js"></script>

<?php 
if(isset($_SESSION['add_car_mensaje'])){
    echo "<script>alert('".$_SESSION['add_car_mensaje']."');</script>";
    unset($_SESSION['add_car_mensaje']);
}
if(isset($_SESSION['delete_car_mensaje'])){
    echo "<script>alert('".$_SESSION['delete_car_mensaje']."');</script>";
    unset($_SESSION['delete_car_mensaje']);
}

require_once("views/pieDePagina.php"); 
?>
