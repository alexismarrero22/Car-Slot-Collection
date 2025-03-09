<?php
    include "../models/User.php";
	$action =  $_GET["action"] ??"";
	if ($action == "register") {
		//userController::addUser();
		echo"adduser";
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
	
	}
	//userController::showUsers(); //forma de llamar a una función estática


	

?>