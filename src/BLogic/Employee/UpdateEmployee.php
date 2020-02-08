<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\Domain\Repository\IEmployeeRepository;

    class UpdateEmployee
    {
        private $repository;
        private $result;
        private $requestData;

        public function __construct(IEmployeeRepository $repository)
        {
            $this->repository = $repository;            
        }

        public function update()
        {
            $this->requestData = $_POST;

            $this->validEmployeeID();

            if ($this->result["success"]) {

                $dbResult = $this->repository->update($this->requestData);

                if ($dbResult["success"]) {

                    $this->result["success"] = true;
    
                } else {
    
                    $this->result["success"] = false;
                    $this->result["error"] = $dbResult["error"];
                }
            }



            return $this->result;
        }

        private function validEmployeeID()
        {
            $dbResult = $this->repository->checkEmployeeID($this->requestData["employee-id"]);

            if ($dbResult["success"]) {

                if ($dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = "Employee ID does not exist.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }
    }