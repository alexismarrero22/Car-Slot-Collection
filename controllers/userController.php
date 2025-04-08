<?php
require_once __DIR__ .  "/../models/User.php";
$action = $_GET["action"] ?? "";
//Segun lo que recibamos en el action, hacemos una cosa u otra
switch ($action) {
	case "register":
		UserController::addUser();
		break;
	case "check":
		UserController::login();
		break;
	case "showUsersByAdmin":
		UserController::showUsersByAdmin();
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
				$plantilla = file_get_contents(__DIR__ . '/userListTemplate.php');
				echo str_replace(
					['{id}', '{name}', '{surname}', '{email}'],
					[$fila["id"], $fila["name"], $fila["surname"], $fila["email"]],
					$plantilla
				);
			}
		}
	}

	public static function showUsersByAdmin(){
		session_start();
		if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
			header('Location: index.php');
			exit();
		}
		$usuario = new User();
		$datos = $usuario->getUsers();
		if (is_string($datos)) {
			echo $datos;
		} else {
			//para no meter html en el controlador, creamos una plantilla a parte
			while ($fila = $datos->fetch_assoc()) {
				$plantilla = file_get_contents(__DIR__ . '/userListTemplateAdmin.php');
				echo str_replace(
					['{id}', '{name}', '{surname}', '{email}', '{rol}', '{estado}', '{acciones}'],
					[$fila["id"], $fila["name"], $fila["surname"], $fila["email"], $fila["rol"], $fila["activo"], ''],
					$plantilla
				);
			}
		}
		
	}
	public static function addUser()
	{
		//recibimos los datos enviados en el formulario y los guardamos en una variable
		$nombre = $_POST['nombreUsuario'] ?? '';
		$apellido = $_POST['apellidosUsuario'] ?? '';
		$email = $_POST['email'] ?? '';
		$password = $_POST['contrasegna'] ?? '';
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
		session_start();
		$email = $_POST['email'] ?? '';
		$password = $_POST['contrasegna'] ?? '';
		// Llamamos al modelo para obtener el usuario
		$userModel = new User();
		$usuario = $userModel->selectUserByEmailAndPassword($email, $password);

		if ($usuario) {
			// Usuario encontrado, se puede iniciar sesión

			$_SESSION['user_rol'] = $usuario['rol'];
			$_SESSION['users_id'] = $usuario['id'];
			$_SESSION['user_email'] = $usuario['email'];
		


			header('Location: ../index.php');
			exit();
		} else {
			// Usuario no encontrado
			$_SESSION['login_message'] = "Usuario o contraseña incorrectos";
			header('Location: ../inicioSesion.php');
			exit();
		}
	}

	public static function showUserNameByid($userId){
		if(empty($userId) || !is_numeric($userId)){
			return "desconocido";
		}
		$usuario = new User();
		$datos = $usuario->selectUserById($userId);

		if($datos && isset($datos['name']) && isset($datos['surname'])){
			return $datos['name'] . " " . $datos['surname'];
		}
		return "desconocido";
	}



}





?>