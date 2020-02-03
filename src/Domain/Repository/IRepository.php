<?php

    namespace GSManager\Domain\Repository;

    interface IRepository
    {
        public function create($entity);
        public function retrieve();
        public function update($data);
        public function delete($id);
        public function getLastInsertID();
    }