<?php
//Si queremos modificar algun parámetro de acceso, basta con cambiarlo en el archivo accessbbdd.php
include_once "accessbbdd.php";
include_once "User.php";

//creamos una función para la conexión con la base de datos
function crearConexion() {
    $conexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $conexion;
}

//creamos una funcion para obtener los usuarios que estan registrados
function getUsers() {
    $db = crearConexion();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if (mysqli_num_rows($result) > 0) {
        $rows = $result-> fetch_all(MYSQLI_ASSOC);

        return $rows;
    } else {
        return "No hay usuarios";
    }
}

//creamos una funcion para añadir usuarios
function addUser($name, $surname, $email, $password) {
    $db = crearConexion();
    $sql = "INSERT INTO users (name, surname, email, password) VALUES ('$name','$surname','$email','$password' )";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if ($result) {
        return $result;
    } else {
        echo "Error al crear el usuario";
    } 
}

//creamos una funcion para eliminar usuarios

function deleteUser($name) {
    $db = crearConexion();
    $sql = "DELETE * FROM users WHERE name = $name";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if (mysqli_num_rows($result) > 0) {  //Comprobamos si hay mas usuarios registrados
        return $result;
    } else {
        return "No hay usuarios";
    }
}


print_r (getUsers()) ;



?>