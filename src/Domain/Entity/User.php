<?php

    namespace GSManager\Domain\Entity;

    class User
    {
        private $id;
        private $name;
        private $surname;
        private $email;
        private $password;
        private $gasStation;

        public function setID($id)
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

        public function setGasStation($gasStation)
        {
            $this->gasStation = $gasStation;
        }
    }