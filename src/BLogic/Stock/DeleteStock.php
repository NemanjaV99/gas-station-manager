<?php

    namespace GSManager\BLogic\Stock;

    use GSManager\BLogic\AbstractDeleteEntity;
    use GSManager\Domain\Repository\IStockRepository;

    class DeleteStock extends AbstractDeleteEntity
    {
        public function __construct(IStockRepository $repository)
        {
            $this->repository = $repository;
        }
    }