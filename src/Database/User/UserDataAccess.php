<?php

    namespace GSManager\Database\User;

    use GSManager\Domain\Repository\IUserRepository;

    class UserDataAccess implements IUserRepository
    {
        public function checkUserEmployee($name, $surname, $gasStation)
        {
            var_dump($name);
        }

        public function checkGasStation($gasStation)
        {
            var_dump($gasStation);
        }

        public function addUser($user)
        {
            var_dump($user);
        }
    }