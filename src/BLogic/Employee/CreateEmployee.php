<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\BLogic\Validator;
    use GSManager\Domain\Entity\Employee;
    use GSManager\Domain\Repository\IEmployeeRepository;

    class CreateEmployee
    {
        private $repository;
        private $validator;
        private $employee;
        private $requestData;
        private $result;

        public function __construct(IEmployeeRepository $repository, Validator $validator, Employee $employee)
        {
            $this->repository = $repository;
            $this->validator = $validator;
            $this->employee = $employee;
        }

        public function create()
        {
            $this->getRequestData();

            $this->validate();

            if ($this->result["success"]) {

                $this->mapToEmployee();
                $this->addEmployee();

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
            $this->requestData["name"] = $this->validator->changeNameCase($this->requestData["name"]);
            $this->requestData["surname"] = $this->validator->changeNameCase($this->requestData["surname"]);

            if (
                $this->validator->checkEmptyAllFields($this->requestData)
                && $this->validator->validateName($this->requestData["name"])
                && $this->validator->validateName($this->requestData["surname"])
            ) {

                $this->result["success"] = true;

            } else {

                $this->result["error"] = $this->validator->getError();
                $this->result["success"] = false;
            }
        }

        private function mapToEmployee()
        {
            $this->employee->setName($this->requestData["name"]);
            $this->employee->setSurname($this->requestData["surname"]);
            $this->employee->setExperience($this->requestData["experience"]);
            $this->employee->setSalary($this->requestData["salary"]);
            $this->employee->setVacationDays($this->requestData["vacation-days"]);
            $this->employee->setIDGasStation($this->requestData["gstation"]);
        }

        private function addEmployee()
        {
            $dbResult = $this->repository->create($this->employee);

            // If result is true, employee has been successfully created.
            if ($dbResult["success"] && $dbResult["result"]) {

                $this->result["success"] = true;

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }
    }