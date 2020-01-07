<?php

    namespace GSManager\BLogic\User;

    use GSManager\Domain\Entity\User;
    use GSManager\Domain\Repository\IUserRepository;

    class RegisterUser
    {
        private $user;
        private $repository;
        private $requestData;
        private $response;

        public function __construct(User $user, IUserRepository $userRepository)
        {
            $this->user = $user;
            $this->repository = $userRepository;
        }

        public function register()
        {
            $this->getRequestData();

            // ---------------
            $this->validate();

            if ($this->response["success"]) {

                $this->validUserEmployee();
                $this->validGasStation();
                $this->hashPassword();
                $this->mapToUser();
                $this->saveUser();

            }

            return $this->response;
            
        }

        private function getRequestData()
        {
            $this->requestData = $_POST;
        }

        private function validate()
        {
           // Only change to true if validation passes
           $this->response["success"] = false;

           if (
               ctype_alpha($this->requestData["name"])
               && ctype_alpha($this->requestData["surname"])
           ) {

               if (filter_var($this->requestData["email"], FILTER_VALIDATE_EMAIL) !== false) {

                   $this->response["success"] = true;

               } else {

                   $this->response["error"] = "Email address is not valid.";
               }

           } else {

                $this->response["error"] = "Name or Last name ";
                $this->response["error"] .= "contains characters that are not allowed.";
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

                $this->response["error"] = "Internal error. Please try again.";
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