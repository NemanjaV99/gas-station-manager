<?php

    namespace GSManager\Domain\Repository;

    interface IUserRepository extends IRepository
    {
        public function checkUserEmployee($name, $surname);
        public function checkEmployeeGasStation($name, $surname, $gasStationID);
        public function checkUserExists($email);
        public function getGasStationNameFromID($gasStationID);
        public function getUserFromEmail($email);
    }