<?php

    namespace GSManager\BLogic\User;

    use GSManager\Domain\Entity\User;
    use GSManager\Domain\Repository\IUserRepository;
    use GSManager\BLogic\User\UserValidator;

    class LoginUser
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

        public function login()
        {
            $this->getRequestData();

            $this->validate();

            if ($this->result["success"]) {

                $userDB = $this->validUser();

                if ($this->result["success"]) {

                    $this->mapToUser($userDB);
                    var_dump($this->user);
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
            $this->requestData = $this->validator->trimAllFields($this->requestData);

            if ($this->validator->checkEmptyAllFields($this->requestData)
                && $this->validator->validateEmail($this->requestData["email"])
            ) {

                $this->result["success"] = true;

            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }
        }

        private function validUser()
        {
            $dbResult = $this->repository->checkUserExists($this->requestData["email"]);

            // This will only change to true if everything is valid
            $this->result["success"] = false;

            if ($dbResult["success"]) {

                // If result is false, it means that user does not exist
                if ($dbResult["result"] !== false) {

                    if ($this->validPassword($dbResult["result"]->LOZINKA)) {

                        $this->result["success"] = true;
                        return $dbResult["result"];

                    } else {

                        $this->result["error"] = "Wrong password.";
                    }

                } else {

                    $this->result["error"] = "User with given email does not exist.";
                }

            } else {

                $this->result["error"] = $dbResult["error"];
            }
        }

        private function validPassword($password)
        {
            return password_verify($this->requestData["password"], $password);
        }

        private function mapToUser($userDB)
        {
            $this->user->setID($userDB->ID_KORISNIK);
            $this->user->setName($userDB->IME);
            $this->user->setSurname($userDB->PREZIME);
            $this->user->setEmail($userDB->EMAIL);
            $this->user->setPassword($userDB->LOZINKA);
            $this->user->setGasStation($userDB->NAZIV_PUMPE);
            $this->user->setRole($userDB->ID_ROLA);
        }
    }