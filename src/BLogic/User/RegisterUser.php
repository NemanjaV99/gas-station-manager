<?php

    namespace GSManager\BLogic\User;

    use GSManager\BLogic\User\UserValidator;
    use GSManager\Domain\Entity\User;
    use GSManager\Domain\Repository\IUserRepository;

    class RegisterUser
    {
        private $user;
        private $repository;
        private $validator;
        private $requestData;
        private $result;

        public function __construct(User $user, IUserRepository $userRepository, UserValidator $userValidator)
        {
            $this->user = $user;
            $this->repository = $userRepository;
            $this->validator = $userValidator;
        }

        public function register()
        {
            $this->getRequestData();

            $this->validate();

            if ($this->result["success"]) {

                $this->validEmployee();

                // If success still true map to user object and add that to DB
                if ($this->result["success"]) {

                    $this->getGasStationNameFromDB();
                    $this->hashPassword();
                    $this->mapToUser();
                    $this->saveUser();
                }

            }

            return $this->result;
            
        }

        private function getRequestData()
        {
            $this->requestData = $_POST;
        }

        private function validate()
        {

            $this->requestData["name"] = $this->validator->changeNameCase($this->requestData["name"]);
            $this->requestData["surname"] = $this->validator->changeNameCase($this->requestData["surname"]);

            if (
                $this->validator->checkEmptyAllFields($this->requestData)
                && $this->validator->validateName($this->requestData["name"])
                && $this->validator->validateName($this->requestData["surname"])
                && $this->validator->validateEmail($this->requestData["email"])
            ) {

                $this->result["success"] = true;

            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }
        }

        private function validEmployee()
        {
            $this->validUserEmployee();

            if ($this->result["success"]) {

                $this->matchEmployeeGasStation();
            }

        }
        
        private function validUserEmployee()
        {
            $dbResult = $this->repository->checkUserEmployee(
                $this->requestData["name"], 
                $this->requestData["surname"], 
                $this->requestData["gstation"]);

            $this->result["success"] = true;

            if ($dbResult["success"]) {

                // If result is false, it means employee does not exist
                if (!$dbResult["result"]) {

                    $this->result["success"] = false;
                    $this->result["error"] = "Employee with given name/surname does not exist.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }

        private function matchEmployeeGasStation()
        {
            $dbResult = $this->repository->checkEmployeeGasStation(
                $this->requestData["name"],
                $this->requestData["surname"],
                $this->requestData["gstation"]
            );

            $this->result["success"] = true;

            if ($dbResult["success"]) {

                // If result is false, it means employee does not work for the given gas station
                if (!$dbResult["result"]) {

                    $this->result["success"] = false;
                    $this->result["error"] = "Employee does not work at this Gas Station.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }

        private function getGasStationNameFromDB()
        {
            $dbResult = $this->repository->getGasStationNameFromID($this->requestData["gstation"]);

            if ($dbResult["success"] && $dbResult["result"] !== false) {

                $this->result["success"] = true;
                $this->requestData["gstation"] = $dbResult["result"];

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }

        private function hashPassword()
        {
            $password = $this->requestData["password"];
            $this->requestData["password"] = password_hash($password, PASSWORD_BCRYPT);
        }

        private function mapToUser()
        {
            $this->user->setName($this->requestData["name"]);
            $this->user->setSurname($this->requestData["surname"]);
            $this->user->setEmail($this->requestData["email"]);
            $this->user->setPassword($this->requestData["password"]);
            $this->user->setGasStation($this->requestData["gstation"]);
        }

        private function saveUser()
        {
            $this->repository->addUser($this->user);
        }
    }