var nombreUsuario = document.getElementById('nombreUsuario').value;
var apellidosUsuario = document.getElementById('apellidosUsuario').value;
var email = document.getElementById('email').value;
var contrasegna = document.getElementById('contrasegna').value;

function enviarFormulario(){
 
    console.log("Enviando formulario", nombreUsuario, apellidosUsuario, email, contrasegna);
    //Array con los mensajes de error
    var mensajesError = [];
    //Verificamos que se envía toda la información
    if(nombreUsuario == null ||nombreUsuario=="")
        mensajesError.push("Falta el nombre del usuario");
    if(apellidosUsuario == null ||apellidosUsuario =="")
        mensajesError.push("Faltan los apellidos del usuario");
    if(email==null || email=="")
        mensajesError.push("Falta el email");
    if(contrasegna == null || contrasegna =="")
        mensajesError.push("Falta la contraseña");

    error.innerHTML = mensajesError.join(", ");
    return false;
}