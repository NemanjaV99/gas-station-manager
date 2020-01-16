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

        public function dbErrorCheck($dbResult)
        {
            if (isset($dbResult["db_error"])) {

                $this->response["success"] = false;
                $this->response["error"] = "Something went wrong. Please try again soon.";
                return false;
            }

            return true;
        }

        public function checkUserEmployee($name, $surname)
        {   

            $query = "SELECT ID_RADNIK FROM radnik WHERE IME = :name AND PREZIME = :surname";
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
            $query = "SELECT ID_RADNIK from radnik WHERE IME = :name AND PREZIME = :surname";
            $query .= " AND ID_PUMPA = :gsID";
            $params = [":name" => $name, ":surname" => $surname, "gsID" => $gasStationID];

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
            $query = "SELECT NAZIV FROM pumpa WHERE ID_PUMPA = :id";
            $params = [":id" => $gasStationID];

            $dbResult = $this->dbConn->executeQuery($query, $params);

            if ($this->dbErrorCheck($dbResult)) {

                $statement = $dbResult["statement"];
                
                $this->response["success"] = true;
                $this->response["result"] = $statement->fetchColumn();

            }

            return $this->response;
        }

        public function addUser($user)
        {
            $query = "INSERT INTO korisnik(IME, PREZIME, EMAIL, LOZINKA, NAZIV_PUMPE) ";
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

        public function checkUserExists($email)
        {
            $query = "SELECT * FROM korisnik WHERE EMAIL = :email";
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
    }