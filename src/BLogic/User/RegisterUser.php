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
                $this->hashPassword();

                // If success still true map to user object and add that to DB
                if ($this->result["success"]) {

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

                $this->result["errors"] = $this->validator->getErrors();
                $this->result["success"] = false;
            }
        }

        private function validEmployee()
        {
            $this->validGasStation();

            if ($this->result["success"]) {

                $this->validUserEmployee();
            }

        }

        private function validGasStation()
        {
            $dbResult = $this->repository->checkGasStation($this->requestData["gstation"]);

            $this->result["success"] = true;

            if ($dbResult["success"]) {

                // If result is false, it means database does not exist
                if (!$dbResult["result"]) {

                    $this->result["success"] = false;
                    $this->result["errors"][] = "Gas Station does not exist.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["errors"][] = $dbResult["error"];
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

                // If result is false, it means user does not exist
                if (!$dbResult["result"]) {

                    $this->result["success"] = false;
                    $this->result["errors"][] = "Employee with given name/surname does not exist.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["errors"][] = $dbResult["error"];
            }
        }

        private function hashPassword()
        {
            $password = $this->requestData["password"];
            $this->requestData["password"] = password_hash($password, PASSWORD_BCRYPT);

            if ($this->requestData["password"] === false) {

                $this->result["errors"][] = "Internal error. Please try again.";
                $this->result["success"] = false;
            }
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