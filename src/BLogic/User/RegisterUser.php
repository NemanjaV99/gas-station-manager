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

                $this->validUserEmployee();
                $this->validGasStation();
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
        
        private function validUserEmployee()
        {
            $this->repository->checkUserEmployee(
                $this->requestData["name"], 
                $this->requestData["surname"], 
                $this->requestData["gstation"]);
        }

        private function validGasStation()
        {
            $this->repository->checkGasStation($this->requestData["gstation"]);
        }

        private function hashPassword()
        {
            $password = $this->requestData["password"];
            $this->requestData["password"] = password_hash($password, PASSWORD_BCRYPT);

            if ($this->requestData["password"] === false) {

                $this->result["errors"] = "Internal error. Please try again.";
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