<?php
//Si queremos modificar algun parámetro de acceso, basta con cambiarlo en el archivo accessbbdd.php
require_once "accessbbdd.php";
require_once "databaseConn.php";

class User extends Database {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    
    //el constructor solo se usa para inicializar la conexión, los valores se asignarán mas adelante a través de otros métodos
    public function __construct(){
        parent::__construct();
    }
    //Getters
    public function getId(){  return $this->id;}
    public function getName(){ return $this->name;}
    public function getSurname(){ return $this->surname;}   
    public function getEmail(){ return $this->email;}
    public function getPassword(){ return $this->password;}
    
    //Setters
    public function setId($id){$this->id=$id;}
    public function setName($name){$this->name=$name;}  
    public function setSurname($surname){$this->surname=$surname;}
    public function setEmail($email){$this->email=$email;}
    public function setPassword($password){$this->password=$password;}



  


    //Añadir un usuario
    public function save(){
        $sql = "INSERT INTO Users(name, surname,email,password) VALUES ('".$this->name."','".$this->surname."','".$this->email."','".$this->password."')";
        $result = $this->conexion->query($sql);
        return $result;
    }

    //Ver los usuarios que hay registrados
/*     public function getUsers() {
		$sql = "SELECT * FROM User";
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$this->setId($row['id']);
			$this->setName($row['name']);
			$this->setSurname($row['surname']);
			$this->setEmail($row['email']);
			$this->setPassword($row['password']);
        
		} else {
			return false;
		}
	}
 */
public function getUsers() {
    $sql = "SELECT * FROM Users"; 
    $result = $this->conexion->query($sql);

    if (!$result) {
        return "Error en la consulta: " . $this->conexion->error;
    }

    if ($result->num_rows == 0) {
        return false; 
    }

    return $result; // Devuelve el objeto mysqli_result para que showUsers() lo procese
}
    //Actualizar un usuario
    public function update() {
		$sql = "UPDATE User SET name = '" . $this->name . "', surname = '" . $this->surname . "', email = '" . $this->email . "', password = '" . $this->password . "' WHERE ID = " . $this->id;
		$result = $this->conexion->query($sql);
		return $result;
	}
    //Eliminar un usuario
    public function delete() {
        $sql = "DELETE FROM User WHERE ID = " . $this->id;
		$result = $this->conexion->query($sql);
		$this->__destruct();
		return $result;
	}


}

?>