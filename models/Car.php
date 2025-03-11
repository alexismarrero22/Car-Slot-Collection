<?php

require_once "accessbbdd.php";
require_once "databaseConn.php";

class Car extends Database
{
    private $idCar;
    private $brand;
    private $model;
    private $manufacturer;
    //el constructor solo se usa para inicializar la conexión, los valores se asignarán mas adelante a través de otros métodos
    public function __construct()
    {
        parent::__construct();
    }
    //getters
    public function getIdCar()
    {
        return $this->idCar;
    }
    public function getBrand()
    {
        return $this->brand;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    //setters

    public function setIdCar($idCar)
    {
        $this->id_car = $idCar;
    }
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
    public function setModel($model)
    {
        $this->model = $model;
    }
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    //Añadir un coche
    public function saveCar()
    {
        $sql = "INSERT INTO Cars(brand,model,manufacturer) VALUES ('" . $this->brand . "','" . $this->model . "','" . $this->manufacturer . "')";
        $result = $this->conexion->query($sql);
        return $result;
    }
    //Mostrar todos los coches
    public function getCars()
    {
        $sql = "SELECT * FROM Cars";
        $result = $this->conexion->query($sql);

        if (!$result) {
            return "Error en la consulta: " . $this->conexion->error;
        }

        if ($result->num_rows == 0) {
            return false;
        }

        return $result;
    }
    //Actualizar un coche
    public function updateCar()
    {
        $sql = "UPDATE Cars SET brand = '" . $this->brand . "', model = '" . $this->model . "', manufacturer = '" . $this->manufacturer . "' WHERE ID = " . $this->idCar;
        $result = $this->conexion->query($sql);
        return $result;
    }
    //Eliminar un coche
    public function deleteCar()
    {
        $sql = "DELETE FROM Cars WHERE ID = " . $this->idCar;
        $result = $this->conexion->query($sql);
        $this->__destruct();
        return $result;
    }



}
?>