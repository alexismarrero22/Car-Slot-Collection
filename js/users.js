

function enviarFormulario(event) {
    event.preventDefault();
    var nombreUsuario = document.getElementById('nombreUsuario');
    var apellidosUsuario = document.getElementById('apellidosUsuario');
    var email = document.getElementById('email');
    var contrasegna = document.getElementById('contrasegna');
    var error = document.getElementById('error');
    console.log("Enviando formulario");
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if (nombreUsuario.value == null || nombreUsuario.value.trim() === "")
        mensajesError.push("Falta el nombre del usuario");
    if (apellidosUsuario.value == null || apellidosUsuario.value.trim() === "")
        mensajesError.push("Faltan los apellidos del usuario");
    if (!email)
        mensajesError.push("Falta el email");
    if (contrasegna.value == null || contrasegna.value === "")
        mensajesError.push("Falta la contraseña");

    //Validacion con patrones
    var emailPattern = /^.+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email.value.trim())) {
        mensajesError.push("El email no es válido");
    }

    var apellidoPattern = /^\s*\S+\s+\S+/;
    if (!apellidoPattern.test(apellidosUsuario.value.trim())) {
        mensajesError.push("Debe introducir al menos dos apellidos");
    }
    if (mensajesError.length === 0) {
        console.log("informacion valida");
        document.getElementById("nuevoUsuario").submit();
        return true;

    }
    error.innerHTML = mensajesError.join("<br>");
    console.log("informacion no valida");
    return false;
}
function enviarformularioUsuarioRegistrado(event) {
    event.preventDefault();
    var email = document.getElementById('email');
    var contrasegna = document.getElementById('contrasegna');
    var error = document.getElementById('error');
    console.log("Enviando formulario");
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if (!email)
        mensajesError.push("Falta el email");
    if (contrasegna.value == null || contrasegna.value === "")
        mensajesError.push("Falta la contraseña");

    //Validamos el email
    var emailPattern = /^.+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email.value.trim())) {
        mensajesError.push("El email o contraseña no es válido");
    }
    if (mensajesError.length === 0) {
        console.log("informacion valida");
        document.getElementById("usuarioRegistrado").submit();
        return true;

    }
    error.innerHTML = mensajesError.join("<br>");
    console.log("informacion no valida");
    return false;

}
function enviarFormularioNuevoCoche(event) {
    event.preventDefault();
    var marca = document.getElementById('marcaCoche');
    var modelo = document.getElementById('modeloCoche');
    var fabricante = document.getElementById('fabricanteCoche');
    var nombreRally = document.getElementById('nombreRally');
    var edicion = document.getElementById('edicionRally');
    var pais = document.getElementById('paisRally');
    var agnoRally = document.getElementById('agnoRally');
    var imagen = document.getElementById('imagenCoche');
    var error = document.getElementById('error');
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if (marca.value == null || marca.value.trim() === "")
        mensajesError.push("Falta la marca del coche");
    if (modelo.value == null || modelo.value.trim() === "")
        mensajesError.push("Falta el modelo del coche");
    if (fabricante.value == null || fabricante.value.trim() === "")
        mensajesError.push("Falta el fabricante del coche");
    if (nombreRally.value == null || nombreRally.value.trim() === "")
        mensajesError.push("Falta el nombre del rally");
    if (edicion.value == null || edicion.value.trim() === "")
        mensajesError.push("Falta la edición del rally");
    if (pais.value == null || pais.value.trim() === "")
        mensajesError.push("Falta el país del rally");
    if (agnoRally.value == null || agnoRally.value.trim() === "")
        mensajesError.push("Falta el año del rally");
    if (imagen.files.length === 0) {
        mensajesError.push("Falta la imagen del coche");
    } else {
        // Validamos extensión del archivo
        var archivo = imagen.files[0].name;
        var extensionPermitida = /\.(jpg|jpeg)$/i;
        if (!extensionPermitida.test(archivo)) {
            mensajesError.push("La imagen debe ser un archivo .jpg o .jpeg");
        }
    }


    if (mensajesError.length === 0) {
        console.log("informacion valida");
        document.getElementById("nuevoCoche").submit();
        return true;
    }
    error.innerHTML = mensajesError.join("<br>");
    console.log("informacion no valida");
    return false;
}
function enviarFormularioCocheCorregido(event) {
    event.preventDefault();
    var marca = document.getElementById('marcaCoche');
    var modelo = document.getElementById('modeloCoche');
    var fabricante = document.getElementById('fabricanteCoche');
    var nombreRally = document.getElementById('nombreRally');
    var edicion = document.getElementById('edicionRally');
    var pais = document.getElementById('paisRally');
    var agnoRally = document.getElementById('agnoRally');

    var error = document.getElementById('error');
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if (marca.value == null || marca.value.trim() === "")
        mensajesError.push("Falta la marca del coche");
    if (modelo.value == null || modelo.value.trim() === "")
        mensajesError.push("Falta el modelo del coche");
    if (fabricante.value == null || fabricante.value.trim() === "")
        mensajesError.push("Falta el fabricante del coche");
    if (nombreRally.value == null || nombreRally.value.trim() === "")
        mensajesError.push("Falta el nombre del rally");
    if (edicion.value == null || edicion.value.trim() === "")
        mensajesError.push("Falta la edición del rally");
    if (pais.value == null || pais.value.trim() === "")
        mensajesError.push("Falta el país del rally");
    if (agnoRally.value == null || agnoRally.value.trim() === "")
        mensajesError.push("Falta el año del rally");

    if (mensajesError.length === 0) {
        console.log("informacion valida");
        document.getElementById("nuevoCoche").submit();
        return true;
    }
    error.innerHTML = mensajesError.join("<br>");
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