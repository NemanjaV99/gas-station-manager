<?php

    namespace GSManager\Domain\Repository;

    interface IUserRepository
    {
        public function checkUserEmployee($name, $surname);
        public function checkEmployeeGasStation($name, $surname, $gasStationID);
        public function getGasStationNameFromID($gasStationID);
        public function addUser($user);

        public function checkUserExists($email);
    }