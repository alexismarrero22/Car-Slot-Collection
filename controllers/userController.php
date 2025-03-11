<?php
include "../models/User.php";
$action = $_GET["action"] ?? "";
//Segun lo que recibamos en el action, hacemos una cosa u otra
switch ($action) {
	case "register":
		userController::addUser();
		break;
	case "check":
		userController::login();
		break;
	default:
		userController::showUsers();
		break;
}

class UserController
{
	public static function showUsers()
	{
		$usuario = new User();
		$datos = $usuario->getUsers();
		if (is_string($datos)) {
			echo $datos;
		} else {
			//para no meter html en el controlador, creamos una plantilla a parte

			while ($fila = $datos->fetch_assoc()) {
				$plantilla = file_get_contents('userListTemplate.php');
				echo str_replace(
					['{id}', '{name}', '{surname}', '{email}', '{password}'],
					[$fila["id"], $fila["name"], $fila["surname"], $fila["email"], $fila["password"]],
					$plantilla
				);
			}
		}
	}
	public static function addUser()
	{
		//recibimos los datos enviados en el formulario y los guardamso en una variable
		$nombre = $_POST['nombreUsuario'] ?? '';
		$apellido = $_POST['apellidosUsuario'] ?? '';
		$email = $_POST['email'] ?? '';
		$password = $_POST['contraseña'] ?? '';
		//comprobamos que no esten vacías
		if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
			exit;
		}
		//Creamos un nuevo objeto User y le damos sus propiedades, luego lo guardamos y vamos a la página de inicio para usuarios registrados(llamando a la función login)
		$usuario = new User();
		$usuario->setName($nombre);
		$usuario->setSurname($apellido);
		$usuario->setEmail($email);
		$usuario->setPassword($password);
		$usuario->save();
		userController::login();

	}

	public static function login()
	{
		$email = $_POST['emailUsuario'] ?? '';
		$password = $_POST['password'] ?? '';
		// Llamamos al modelo para obtener el usuario
		$userModel = new User();
		$usuario = $userModel->selectUserByEmailAndPassword($email, $password);

		if ($usuario) {
			// Usuario encontrado, se puede iniciar sesión
			session_start();
			$_SESSION['users_id'] = $usuario['id'];
			$_SESSION['users_email'] = $usuario['email'];


			header('Location: ../index.php');
			exit();
		} else {
			// Usuario no encontrado
			echo "Error: Usuario o contraseña incorrectos.";
		}
	}



}
//userController::showUsers(); //forma de llamar a una función estática




?>