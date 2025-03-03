<?php
    class User{
        private int $id;
        private string $name;
        private string $surname;
        private string $email;
        private string $password;
        public function __construct(int $id, string $name, string $surname, string $email, string $password){
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->password = $password;
        }

        public function __tostring(){
            return "User: {$this->id} {$this->name} {$this->surname}, email: {$this->email}, password: {$this->password}";
        }

    }
    

?>