

function enviarFormulario(){
    var nombreUsuario = document.getElementById('nombreUsuario');
    var apellidosUsuario = document.getElementById('apellidosUsuario');
    var email = document.getElementById('email');
    var contraseña = document.getElementById('contraseña');
    console.log("Enviando formulario");
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if(nombreUsuario.value == null ||nombreUsuario.value=="")
        mensajesError.push("Falta el nombre del usuario");
    if(apellidosUsuario.value == null ||apellidosUsuario.value =="")
        mensajesError.push("Faltan los apellidos del usuario");
    if(email.value==null || email.value=="")
        mensajesError.push("Falta el email");
    if(contraseña.value == null || contraseña.value =="")
        mensajesError.push("Falta la contraseña");

    error.innerHTML = mensajesError.join(", ");
    return false;
}