<?php

    namespace GSManager\BLogic\User;

    use GSManager\Domain\Repository\IUserRepository;
    use GSManager\BLogic\Validator;

    class UpdateUser
    {
        private $repository;
        private $requestData;
        private $result;
        private $validator;

        public function __construct(IUserRepository $repository, Validator $validator)
        {
            $this->repository = $repository;
            $this->validator = $validator;
        }

        public function updateEmail($id)
        {
            $this->requestData["id"] = $id;
            $this->requestData["email"] = $_POST["email"];
            $this->requestData["old-password"] = $_POST["old-password"];

            $this->validate();

            if ($this->result["success"]
                && $this->validator->validateEmail($this->requestData["email"])) {

                $this->checkCurrentPassword();

                if ($this->result["success"]) {

                    $data["id"] = $this->requestData["id"];
                    $data["email"] = $this->requestData["email"];
                    $data["password"] = null;

                    $dbResult = $this->repository->update($data);

                    if ($dbResult["success"]) {

                        $this->result["success"] = true;
        
                    } else {
        
                        $this->result["success"] = false;
                        $this->result["error"] = $dbResult["error"];
                    }

                }

            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }

            return $this->result;
        }

        public function updatePassword($id)
        {
            $this->requestData["id"] = $id;
            $this->requestData["new-password"] = $_POST["new-password"];
            $this->requestData["old-password"] = $_POST["old-password"];

            $this->validate();

            if ($this->result["success"]) {

                $this->checkCurrentPassword();

                if ($this->result["success"]) {
 
                    $this->hashPassword();

                    $data["id"] = $this->requestData["id"];
                    $data["password"] = $this->requestData["new-password"];
                    $data["email"] = null;

                    $dbResult = $this->repository->update($data);

                    if ($dbResult["success"]) {

                        $this->result["success"] = true;
        
                    } else {
        
                        $this->result["success"] = false;
                        $this->result["error"] = $dbResult["error"];
                    }
                }
                
            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }

            return $this->result;
        }

        private function validate()
        {
            $this->requestData = $this->validator->trimAllFields($this->requestData);

            if ($this->validator->checkEmptyAllFields($this->requestData)) {

                $this->result["success"] = true;

            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }
        }

        private function checkCurrentPassword()
        {
            $dbResult = $this->repository->getPassword($this->requestData["id"]);

            if ($dbResult["success"]) {

                if (password_verify($this->requestData["old-password"], $dbResult["result"])) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = "Check your password.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }

        private function hashPassword()
        {
            $password = $this->requestData["new-password"];
            $this->requestData["new-password"] = password_hash($password, PASSWORD_BCRYPT);
        }
    }