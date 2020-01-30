<?php

    namespace GSManager\Database\Employee;

    use GSManager\Domain\Repository\IDataAccess;
    use GSManager\Database\DatabaseConnection;

    class EmployeeDataAccess implements IDataAccess
    {
        private $dbConn;
        private $response;

        public function __construct(DatabaseConnection $dbConn)
        {
            $this->dbConn = $dbConn;
        }

        public function create($entity)
        {
            
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

        public function update($entity)
        {
            
        }

        public function delete($id)
        {
            
        }

        public function getLastInsertID()
        {
            
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