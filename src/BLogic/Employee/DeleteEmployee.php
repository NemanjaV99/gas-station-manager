<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\Domain\Repository\IEmployeeRepository;

    class DeleteEmployee
    {
        private $repository;
        private $deleteID;
        private $result;

        public function __construct(IEmployeeRepository $repository)
        {
            $this->repository = $repository;
        }

        public function delete()
        {
            $this->getDeleteID();
            $dbResult = $this->repository->delete($this->deleteID);

            $this->result["success"] = false;

            if ($dbResult["success"]) {

                if ($dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["error"] = "ID does not exist.";
                }

            } else {

                $this->result["error"] = $dbResult["error"];
            }

            return $this->result;
        }

        private function getDeleteID()
        {
            $this->deleteID = $_POST["delete-id"];
        }
    }