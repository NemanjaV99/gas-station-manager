<?php

    namespace GSManager\BLogic;

    abstract class AbstractDeleteEntity
    {
        protected $repository;
        protected $deleteID;
        protected $dbDeleteResult;

        public function delete()
        {
            $this->getDeleteID();
            $dbResult = $this->repository->delete($this->deleteID);

            $this->dbDeleteResult["success"] = false;

            if ($dbResult["success"]) {

                if ($dbResult["result"]) {

                    $this->dbDeleteResult["success"] = true;

                } else {

                    $this->dbDeleteResult["error"] = "ID does not exist.";
                }

            } else {

                $this->dbDeleteResult["error"] = $dbResult["error"];
            }

            return $this->dbDeleteResult;
        }

        protected function getDeleteID()
        {
            $this->deleteID = $_POST["delete-id"];
        }
    }