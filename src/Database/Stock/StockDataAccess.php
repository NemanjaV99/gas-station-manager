<?php

    namespace GSManager\Database\Stock;

    use GSManager\Database\DatabaseConnection;
    use GSManager\Domain\Repository\IStockRepository;

    class StockDataAccess implements IStockRepository
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
            $query = "SELECT gsf.ID_GAS_STATION_FUEL, gs.NAME AS GAS_STATION_NAME, f.NAME AS FUEL_NAME, gsf.AMOUNT_LITER ";
            $query .= "FROM gas_station_fuel gsf JOIN gas_station gs ON gsf.ID_GAS_STATION ";
            $query .= "= gs.ID_GAS_STATION JOIN fuel f ON gsf.ID_FUEL = f.ID_FUEL ";

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
            $query = "DELETE FROM gas_station_fuel WHERE ID_GAS_STATION_FUEL = :id";
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