<?php

    namespace GSManager\BLogic\Stock;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IDataAccess;

    class GetStock extends AbstractGetEntity
    {
        public function __construct(IDataAccess $repository)
        {
            $this->repository = $repository;
        }
    }