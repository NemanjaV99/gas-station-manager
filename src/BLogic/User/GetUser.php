<?php

    namespace GSManager\BLogic\User;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IUserRepository;

    class GetUser extends AbstractGetEntity
    {
        public function __construct(IUserRepository $repository)
        {
            $this->repository = $repository;
        }

        public function get()
        {
            $this->dbGetResult = $this->repository->retrieve();
            $this->removePasswordFromResult();
            $this->removeUnderscoreFromResultKeys();

            return $this->dbGetResult;
        }

        public function getByID($id)
        {
            $this->dbGetResult = $this->repository->getByID($id);
            $this->removeUnderscoreFromResultKeys();
            return $this->dbGetResult;
        }

        private function removePasswordFromResult()
        {
            if ($this->dbGetResult["success"]) {
   
                foreach ($this->dbGetResult["result"] as &$user) {
                    unset($user["PASSWORD"]);
                }
            }
        }
    }