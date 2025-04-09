<?php require_once("views/cabecera.php"); ?>
<h1>¡Ponte en contacto con nosotros!</h1>
<h3 style="text-align: center;">¿Tienes dudas, sugerencias o simplemente quieres hablarnos de tu coche slot favorito?</h3>
<h3 style="text-align: center;">¡Estaremos encantados de leerte!</h3>
<form action="index.php" method="post" autocomplete="off">
    <label for="nombre">Tu nombre de piloto:</label>
    <input type="text" id="nombre" name="nombre"><br><br>

    <label for="email">Tu email de boxes:</label>
    <input type="email" id="email" name="email"><br><br>

    <label for="mensaje">Tu mensaje de rally</label><br>
    <textarea id="mensaje" name="mensaje" rows="4" cols="50"></textarea><br><br>

    <button type="submit">Enviar 🚗💨</button>
</form>
<p style="margin-top:30px; text-align:center;">
    <i><b>🏁 Gracias por contactar con Car Slot Collection.  
    Prometemos no usar tus datos para cronometrar vueltas... 😉</b></i>
</p>

<?php require_once("views/pieDePagina.php"); ?>