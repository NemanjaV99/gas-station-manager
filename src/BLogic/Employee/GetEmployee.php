<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IEmployeeRepository;

    class GetEmployee extends AbstractGetEntity
    {
        public function __construct(IEmployeeRepository $repository)
        {
            $this->repository = $repository;
        }
    }