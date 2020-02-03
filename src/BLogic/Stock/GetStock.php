<?php

    namespace GSManager\BLogic\Stock;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IStockRepository;

    class GetStock extends AbstractGetEntity
    {
        public function __construct(IStockRepository $repository)
        {
            $this->repository = $repository;
        }
    }