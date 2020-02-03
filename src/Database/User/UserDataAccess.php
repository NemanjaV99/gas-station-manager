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

        public function create($user)
        {
            $query = "INSERT INTO user(NAME, SURNAME, EMAIL, PASSWORD, GAS_STATION_NAME) ";
            $query .= "VALUES (:name, :surname, :email, :pass, :gstation)";

            $params[":name"] = $user->getName();
            $params[":surname"] = $user->getSurname();
            $params[":email"] = $user->getEmail();
            $params[":pass"] = $user->getPassword();
            $params[":gstation"] = $user->getGasStation();

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
            $query = "SELECT * FROM user";

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
            $query = "DELETE FROM user WHERE ID_USER = :id";
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

        public function checkUserEmployee($name, $surname)
        {   

            $query = "SELECT ID_EMPLOYEE FROM employee WHERE NAME = :name AND SURNAME = :surname";
            $params = [":name" => $name, ":surname" => $surname];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function checkEmployeeGasStation($name, $surname, $gasStationID)
        {
            $query = "SELECT ID_EMPLOYEE from employee WHERE NAME = :name AND SURNAME = :surname";
            $query .= " AND ID_GAS_STATION = :gsID";
            $params = [":name" => $name, ":surname" => $surname, "gsID" => $gasStationID];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function checkUserExists($email)
        {
            $query = "SELECT NAME, SURNAME FROM user WHERE EMAIL = :email";
            $params = [":email" => $email];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->rowCount() > 0;

            }

            return $this->response;
        }

        public function getGasStationNameFromID($gasStationID)
        {
            $query = "SELECT NAME FROM gas_station WHERE ID_GAS_STATION = :id";
            $params = [":id" => $gasStationID];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->fetchColumn();

            }

            return $this->response;
        }

        public function getUserFromEmail($email)
        {
            $query = "SELECT * FROM user WHERE EMAIL = :email";
            $params = [":email" => $email];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $this->response["success"] = true;
                $statement = $dbResult["statement"];
                
                if ($statement->rowCount() > 0) {

                    $this->response["result"] = $statement->fetchObject();

                } else {

                    $this->response["result"] = false;
                }

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