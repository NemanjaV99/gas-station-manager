<?php

    namespace GSManager\BLogic\Stock;

    use GSManager\Domain\Repository\IStockRepository;

    class CreateStock
    {
        private $repository;
        private $requestData;
        private $result;

        public function __construct(IStockRepository $repository)
        {
            $this->repository = $repository;
        }

        public function create()
        {
            $this->requestData["gas_station_id"] = $_POST["gstation"];
            $this->requestData["fuel_id"] = $_POST["fuel"];
            $this->requestData["amount"] = $_POST["amount"];

            $this->checkAlreadyExists();

            if ($this->result["success"]) {

                $dbResult = $this->repository->create($this->requestData);

                if ($dbResult["success"] && $dbResult["result"]) {

                    $this->result["success"] = true;
    
                } else {
    
                    $this->result["success"] = false;
                    $this->result["error"] = $dbResult["error"];
                }

            }

            return $this->result;

        }

        private function checkAlreadyExists()
        {
            $dbResult = $this->repository->alreadyExists(
                $this->requestData["gas_station_id"],
                $this->requestData["fuel_id"]);

            if ($dbResult["success"]) {
                
                // If true, stock already exists
                if (!$dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = "Stock already exists.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }

        }

    }