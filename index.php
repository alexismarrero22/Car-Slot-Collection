<?php require_once("views/cabecera.php"); ?>

<!-- Divisor del contenido -->
<div id="contenido">
    <h1>Bienvenid@s a Car Slot Collection</h1>
   
</div>
<div id="carrusel-container" style="text-align: center;">
    <button id="prev">⬅ Anterior</button>
    <div id="carrusel" style="width: 500px; height: auto; overflow: hidden; display: inline-block;">
            <!-- Aquí se insertarán las imágenes dinámicamente -->
    </div>
         <button id="next">Siguiente ➡</button>
</div>

<script src="js/carrusel.js"></script>
<?php require_once("views/pieDePagina.php"); ?>