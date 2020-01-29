<?php

    namespace GSManager\Domain\Entity;

    class Employee
    {
        private $id;
        private $name;
        private $surname;
        private $experience;
        private $salary;
        private $vacationDays;
        private $idGasStation;

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

        public function getExperience()
        {
            return $this->experience;
        }

        public function getSalary()
        {
            return $this->salary;
        }

        public function getVacationDays()
        {
            return $this->vacationDays;
        }

        public function getIDGasStation()
        {
            return $this->idGasStation;
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

        public function setExperience($experience)
        {
            $this->experience = $experience;
        }

        public function setSalary($salary)
        {
            $this->salary = $salary;
        }

        public function setVacationDays($vacationDays)
        {
            $this->vacationDays = $vacationDays;
        }

        public function setIDGasStation($idGasStation)
        {
            $this->idGasStation = $idGasStation;
        }
    }