<?php

    namespace GSManager\Domain\Repository;

    interface IUserRepository
    {
        public function checkUserEmployee($name, $surname);
        public function checkEmployeeGasStation($name, $surname, $gasStationID);
        public function checkUserExists($email);
        public function getGasStationNameFromID($gasStationID);
        public function addUser($user);

        public function getUserWithEmail($email);
        public function getLastInsertID();
    }