<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IDataAccess;

    class GetEmployee extends AbstractGetEntity
    {
        public function __construct(IDataAccess $repository)
        {
            $this->repository = $repository;
        }
    }