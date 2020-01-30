<?php

    namespace GSManager\BLogic;

    abstract class AbstractGetEntity
    {
        protected $repository;
        protected $dbGetResult;

        public function get()
        {
            $this->dbGetResult = $this->repository->retrieve();
            $this->removeUnderscoreFromResultKeys();
            return $this->dbGetResult;
        }

        protected function removeUnderscoreFromResultKeys()
        {
            if ($this->dbGetResult["success"]) {

                foreach ($this->dbGetResult["result"] as &$each) {
                    foreach ($each as $key => $value) {
                        $replaced = str_replace("_", " ", $key);
                        $tmpArray[$replaced] = $value;
                    }

                    $each = $tmpArray;
                }

            }
        }

    }