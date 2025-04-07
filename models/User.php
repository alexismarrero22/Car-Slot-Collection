<?php
//Si queremos modificar algun parámetro de acceso, basta con cambiarlo en el archivo accessbbdd.php
require_once "accessbbdd.php";
require_once "databaseConn.php";

class User extends Database
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $rol;
    private $activo;

    //el constructor solo se usa para inicializar la conexión, los valores se asignarán mas adelante a través de otros métodos
    public function __construct()
    {
        parent::__construct();
    }
    //Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getActivo()
    {
        return $this->activo;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }


    //Añadir un usuario
    public function save()
    {
        //Si no se ha asignado un rol, se asigna el de usuario por defecto
        if(!$this->rol){
            $this->rol = "usuario";
        }
        if($this->activo == null){
            $this->activo = true; // Por defecto, activo
        }
        $sql = "INSERT INTO Users(name, surname,email,password,rol,activo) VALUES ('" . $this->name . "','" . $this->surname . "','" . $this->email . "','" . $this->password . "','" . $this->rol . "'," . $this->activo . ")";
        $result = $this->conexion->query($sql);
        return $result;
    }

    //Mostrar usuarios
    public function getUsers()
    {
        $sql = "SELECT * FROM Users";
        $result = $this->conexion->query($sql);
        return $result; // Devuelve el objeto mysqli_result para que showUsers() lo procese
    }
    //Actualizar un usuario
    public function update()
    {
        $sql = "UPDATE User SET name = '" . $this->name . "', surname = '" . $this->surname . "', email = '" . $this->email . "', password = '" . $this->password . "' WHERE ID = " . $this->id;
        $result = $this->conexion->query($sql);
        return $result;
    }
    //Eliminar un usuario
    public function delete()
    {
        $sql = "DELETE FROM Users WHERE ID = " . $this->id;
        $result = $this->conexion->query($sql);
        $this->__destruct();
        return $result;
    }

    //Mostrar un único usuario
    public function selectUserByEmailAndPassword($email, $password)
    {
        // Sentencia preparada para evitar inyección SQL
        $sql = "SELECT * FROM Users WHERE email = ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $email); // "s" indica que es un string
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc(); // Retorna un array asociativo con el usuario encontrado

        if ($usuario && $usuario['password'] === $password) {
            return $usuario; // Retorna el usuario si la contraseña coincide
        } else {
            return null; // No se encontró el usuario o la contraseña no coincide
        }
    }

    //Mostrar un único usuario por id
    public function selectUserById($id)
    {
        $sql = "SELECT name, surname FROM Users WHERE ID = $id";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Retorna un array asociativo con el usuario encontrado
        } else {
            return null; // No se encontró el usuario
        }
    }

    //Cambiar el estado de un usuario (bloquear/desbloquear)
    public function toggleActivo()
    {
        $sql = "UPDATE Users SET activo = NOT activo WHERE ID = " . $this->id;
        $result = $this->conexion->query($sql);
        return $result;
    }





}

?>