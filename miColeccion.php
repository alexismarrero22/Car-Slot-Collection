<?php require_once("views/cabecera.php"); ?>
<link rel="stylesheet" type="text/css" href="css/carrusel.css">
    <!-- Divisor del contenido -->
     <div>
        <form id="nuevoCoche" action="controllers/carController.php?action=register" method="post" enctype="multipart/form-data">
            <label for="marcaCoche">Marca</label><br>
            <input type="text" id="marcaCoche" name="marcaCoche"><br>

            <label for="modeloCoche">Modelo</label><br>
            <input type="text" id="modeloCoche" name="modeloCoche"><br>

            <label for="fabricanteCoche">Fabricante</label><br>
            <input type="text" id="fabricanteCoche" name="fabricanteCoche"><br>

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

     <script src="js/carrusel.js"></script>

