<?php

    namespace GSManager\Domain\Repository;

    interface IDataAccess
    {
        public function create($entity);
        public function retrieve();
        public function update($entity);
        public function delete($id);
        public function getLastInsertID();
    }