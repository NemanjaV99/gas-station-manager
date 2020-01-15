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
        private $role;

        public function getID()
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

        public function getGasStation()
        {
            return $this->gasStation;
        }

        public function getRole()
        {
            return $this->role;
        }

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

        public function setRole($role)
        {
            $this->role = $role;
        }
    }