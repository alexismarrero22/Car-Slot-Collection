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
     <div class="carrusel-container">
        <h1>hola mono</h1>
        <button class="prev">&#10094;</button>
        <div class="carrusel"></div>
        <button class="next">&#10095;</button>
     </div>
     <script src="js/carrusel.js"></script>

