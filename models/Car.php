<?php

require_once "accessbbdd.php";
require_once "databaseConn.php";

class Car extends Database
{
    private $id_car;
    private $brand;
    private $model;
    private $manufacturer;
    private $decoration;
    //el constructor solo se usa para inicializar la conexión, los valores se asignarán mas adelante a través de otros métodos
    public function __construct()
    {
        parent::__construct();
    }
    //getters
    public function getIdCar()
    {
        return $this->id_car;
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
    public function getDecoration()
    {
        return $this->decoration;
    }


    //setters

    public function setIdCar($id_car)
    {
        $this->id_car = $id_car;
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
    public function setDecoration($decoration)
    {
        $this->decoration = $decoration;
    }


    //Añadir un coche
    public function saveCar($userId)
    {
        $sql = "INSERT INTO Cars(brand,model,manufacturer,decoration) VALUES ('$this->brand','$this->model','$this->manufacturer','$this->decoration')";
        $stmt = $this->conexion->prepare($sql);
        //$stmt->bind_param( $this->brand, $this->model, $this->manufacturer, $this->decoration);

        if (!$stmt->execute()) {
            return false; //error al insertar en la tabla cars
        }

        //obtenemos el id del coche que acabamos de añadir
        $idCar = $this->conexion->insert_id;

        //insertamos la relación en la tabla usercar
        $sqlUserCar = "INSERT INTO UserCar(id,id_car) VALUES ($userId,$idCar)";
        $stmtUserCar = $this->conexion->prepare($sqlUserCar);
        return $stmtUserCar->execute();
        
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
    public function updateCar($carId, $userId,$marca,$modelo,$fabricante){
        $sql = "UPDATE Cars SET brand = '$marca', model = '$modelo', manufacturer = '$fabricante' WHERE id_car = $carId AND id_car IN (SELECT id_car FROM usercar WHERE id = $userId)";
        $result = $this->conexion->query($sql);
        return $result;
    }
    
        
    
    //Eliminar un coche
    public function deleteCar($userId,$carId){
        $sql = "DELETE FROM UserCar WHERE id = $userId AND id_car = $carId";
        $result = $this->conexion->query($sql);
        return $result;
    }

 

    //Motrar las decoraciones
    public function getDecorations(){
        $decorations = [];
        $sql= "SELECT decoration FROM Cars";
        $result = $this->conexion->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $decorations[] = $row['decoration'];
            }
        }
        
        return $decorations;
    }
    public function getMyOwnDecorations($userId): array
    {
        $decorations = [];
        $sql = "SELECT decoration FROM cars WHERE id_car IN (SELECT id_car FROM usercar WHERE id = " . $userId . ")";
        $result = $this->conexion->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $decorations[] = $row['decoration'];
            }
        }
        return $decorations;
    }
    public function getMyOwnCars($userId){    
        $sql = "SELECT * FROM cars WHERE id_car IN (SELECT id_car FROM usercar WHERE id = " . $userId . ")";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0){
             return $result;
        }else{
            return "No hay coches en tu colección";
        }
   
    }

    public function getCarById($carId, $userId){
        $sql = "SELECT brand, model, manufacturer FROM cars WHERE id_car = $carId AND id_car IN (SELECT id_car FROM usercar WHERE id = $userId)";
        $result = $this->conexion->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
}

?>