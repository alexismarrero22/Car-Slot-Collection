<?php
    include "model.php";


    function showUsers(){
        $datos = getUsers();
        //Si hemos recibido un mensaje de error lo mostramos
        if(is_string($datos)){
            echo $datos;
        }else{// Si hemos recibido datos
		// Obtenemos cada una de las filas de datos que nos devolvió la consulta.
		// mysqli_fetch_assoc avanza entre cada uno de los elementos del array 
		// que contiene cada vez que se llama, hasta que no haya más.
			while ($fila = mysqli_fetch_assoc($datos)) {
				echo "<tr>\n
						<td>" . $fila["id"] . "</td>\n
						<td>" . $fila["name"] . "</td>\n
						<td>" . $fila["surname"] . "</td>\n
						<td>" . $fila["email"] . "</td>\n
						<td>" . $fila["password"] . "</td>\n
					</tr>";
			}
			mysqli_free_result($datos); 
        }

        
    }
	

?>