<?php

    namespace GSManager\Database\User;

    use GSManager\Domain\Repository\IUserRepository;
    use GSManager\Database\DatabaseConnection;

    class UserDataAccess implements IUserRepository
    {
        private $dbConn;
        private $response;

        public function __construct(DatabaseConnection $dbConn)
        {
            $this->dbConn = $dbConn;
        }

        public function checkUserEmployee($name, $surname)
        {   

            $query = "SELECT ID_RADNIK FROM radnik WHERE IME = :name AND PREZIME = :surname";
            $params = [":name" => $name, ":surname" => $surname];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if (!isset($dbResult["db_error"]) 
                && $dbResult["query_exec_result"]
            ) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            } else {

                $this->response["success"] = false;
                $this->response["error"] = "Something went wrong. Please try again soon.";
            }

            return $this->response;
        }

        public function checkGasStation($gasStation)
        {
            $query = "SELECT ID_PUMPA FROM pumpa WHERE NAZIV = :gstation";
            $params = [":gstation" => $gasStation];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if (!isset($dbResult["db_error"]) 
                && $dbResult["query_exec_result"]
            ) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            } else {

                $this->response["success"] = false;
                $this->response["error"] = "Something went wrong. Please try again soon.";
            }

            return $this->response;
        }

        public function addUser($user)
        {
            var_dump($user);
        }
    }