<?php

    require_once "accessbbdd.php";
    require_once "databaseConn.php";

    class Rally extends Database{
        private $id_rally;
        private $nameRally;
        private $edition;
        private $country;
        private $year;

        //creamos el constructor
        public function __construct(){
            parent::__construct();
        }
        //getters
        public function getIdRally(){
            return $this->id_rally;
        }
        public function getNameRally(){
            return $this->nameRally;
        }
        public function getEdition(){
            return $this->edition;
        }
        public function getCountry(){
            return $this->country;
        }
        public function getYear(){
            return $this->year;
        }
        //setters
        public function setIdRally($id_rally){
            $this->id_rally = $id_rally;
        }
        public function setName($nameRally){
            $this->nameRally = $nameRally;
        }
        public function setEdition($edition){
            $this->edition = $edition;
        }
        public function setCountry($country){
            $this->country = $country;
        }
        public function setYear($year){
            $this->year = $year;
        }

        //método para guardar un rally que haya corrdio un coche en la base de datos
        public function saveRally($carId){
            $sql = "INSERT INTO rallies (nameRally, edition, country, year) VALUES ('$this->nameRally', '$this->edition', '$this->country', '$this->year')";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                return false;   //error al insertar en la tabla rallies
            }
            //obtenemos el id del rally que acabamos de añadir
            $idRally = $this->conexion->insert_id;

            //insertamos la relacion en la tabla carRally
            $sqlCarRally = "INSERT INTO carRally (id_car, id_rally) VALUES ('$carId', '$idRally')";
            $stmtCarRally = $this->conexion->prepare($sqlCarRally);
            $stmtCarRally->execute(); 
        }
  

    }

?>