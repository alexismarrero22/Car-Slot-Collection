

function enviarFormulario(event) {
    event.preventDefault();
    var nombreUsuario = document.getElementById('nombreUsuario');
    var apellidosUsuario = document.getElementById('apellidosUsuario');
    var email = document.getElementById('email');
    var contraseña = document.getElementById('contraseña');
    console.log("Enviando formulario");
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if (nombreUsuario.value == null || nombreUsuario.value == "")
        mensajesError.push("Falta el nombre del usuario");
    if (apellidosUsuario.value == null || apellidosUsuario.value == "")
        mensajesError.push("Faltan los apellidos del usuario");
    if (email.value == null || email.value == "")
        mensajesError.push("Falta el email");
    if (contraseña.value == null || contraseña.value == "")
        mensajesError.push("Falta la contraseña");
    if (mensajesError.length == 0) {
        console.log("informacion valida");
        document.getElementById("nuevoUsuario").submit();
        return true;

    }
    error.innerHTML = mensajesError.join(", ");
    console.log("informacion no valida");
    return false;
}

function openUserCollection(userId) {
    window.open(`coleccionParticular.php?userId=${userId}`, '_blank');
}

function mostrarDecoracion(id_car) {
    fetch("controllers/carController.php?action=showImagesById&id_car=" + id_car)
        .then(response => response.text())
        .then(html => {
            const modal = document.getElementById("modalDecoracion");
            const contenido = document.getElementById("contenidoModalDecoracion");

            contenido.innerHTML = html;
            modal.style.display = "block";
        })
        .catch(error => {
            alert("No se pudo cargar la decoración.");
            console.error(error);
        });
}

function cerrarModalDecoracion() {
    document.getElementById("modalDecoracion").style.display = "none";
}