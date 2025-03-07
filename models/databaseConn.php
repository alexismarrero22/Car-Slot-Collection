<?php
    require_once("accessbbdd.php");
    //creamos una clase Database para la conexion
    class Database {
        protected $conexion;
        public function __construct($host = HOST, $user = USER, $pass = PASSWORD, $dbname = DATABASE) {
            $this->conexion = new mysqli($host, $user, $pass, $dbname);
            if ($this->conexion->connect_error) {
                die("Error de conexión con la base de datos: " . $this->conexion->connect_error);
            }
        }
    
        public function __destruct()
        {
            $this->conexion->close();
        }
    }

?>