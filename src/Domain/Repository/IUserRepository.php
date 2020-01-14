<?php

    namespace GSManager\Domain\Repository;

    interface IUserRepository
    {
        public function checkUserEmployee($name, $surname);
        public function checkGasStation($gasStation);
        public function addUser($user);
    }