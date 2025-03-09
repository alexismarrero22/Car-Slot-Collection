<?php
    include "../models/User.php";
	$action = isset($_GET["action"]) ? $_GET["action"] :"";
	if ($action == "register") {
		userController::addUser();
	}else{
		userController::showUsers();
	}

	class UserController {
		public static function showUsers() {
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
		public static function addUser() {
			
			$nombre = $_POST['nombreUsuario'] ?? '';
			$apellido = $_POST['apellidosUsuario'] ?? '';
			$email=$_POST['email'] ?? '';
			$password=$_POST['contrasegna'] ?? '';
			if(empty($nombre) || empty($apellido) || empty($email) || empty($password)){
				exit;
			}
			$usuario = new User();
			$usuario->setName($nombre);
			$usuario->setSurname($apellido);
			$usuario->setEmail($email);
			$usuario->setPassword($password);
			$usuario->save();
		}
	
	}
	//userController::showUsers(); //forma de llamar a una función estática


	

?>