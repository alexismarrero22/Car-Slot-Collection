<?php

    require_once "accessbbdd.php";
    require_once "databaseConn.php";

    class Rally extends Database{
        private $id_rally;
        private $name;
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
        public function getName(){
            return $this->name;
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
        public function setName($name){
            $this->name = $name;
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
    }

?>