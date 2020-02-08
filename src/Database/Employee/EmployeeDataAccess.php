<?php

    namespace GSManager\Database\Employee;

    use GSManager\Database\DatabaseConnection;
    use GSManager\Domain\Repository\IEmployeeRepository;

    class EmployeeDataAccess implements IEmployeeRepository
    {
        private $dbConn;
        private $response;

        public function __construct(DatabaseConnection $dbConn)
        {
            $this->dbConn = $dbConn;
        }

        public function create($employee)
        {
            $query = "INSERT INTO employee(NAME, SURNAME, EXPERIENCE, SALARY, ";
            $query .= "VACATION_DAYS, ID_GAS_STATION) ";
            $query .= "VALUES (:name, :surname, :experience, :salary, :vdays, :gsID)";

            $params[":name"] = $employee->getName();
            $params[":surname"] = $employee->getSurname();
            $params[":experience"] = $employee->getExperience();
            $params[":salary"] = $employee->getSalary();
            $params[":vdays"] = $employee->getVacationDays();
            $params[":gsID"] = $employee->getIDGasStation();

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function retrieve()
        {
            $query = "SELECT * FROM employee";

            $dbResult = $this->dbConn->executeQuery($query);

            if ($this->dbErrorCheck($dbResult)) {

                $this->response["success"] = true;
                $statement = $dbResult["statement"];
                
                if ($statement->rowCount() > 0) {

                    $this->response["result"] = $statement->fetchAll();

                } else {

                    $this->response["result"] = false;
                }

            }

            return $this->response;
        }

        public function update($data)
        {
            $query = "UPDATE employee SET EXPERIENCE = :exp, SALARY = :salary, ";
            $query .= "VACATION_DAYS = :vdays, ID_GAS_STATION = :gsID ";
            $query .= "WHERE ID_EMPLOYEE = :empID";

            $params[":exp"] = $data["experience"];
            $params[":salary"] = $data["salary"];
            $params[":vdays"] = $data["vacation-days"];
            $params[":gsID"] = $data["gstation"];
            $params[":empID"] = $data["employee-id"];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function delete($id)
        {
            $query = "DELETE FROM employee WHERE ID_EMPLOYEE = :id";
            $params[":id"] = $id;

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function getLastInsertID()
        {
            return $this->dbConn->lastInsertID();
        }

        public function checkEmployeeID($id)
        {
            $query = "SELECT ID_EMPLOYEE FROM employee WHERE ID_EMPLOYEE = :id";
            $params[":id"] = $id;

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        private function dbErrorCheck($dbResult)
        {
            if (isset($dbResult["db_error"])) {

                $this->response["success"] = false;
                $this->response["error"] = "Something went wrong. Please try again soon.";
                return false;
            }

            return true;
        }
    }