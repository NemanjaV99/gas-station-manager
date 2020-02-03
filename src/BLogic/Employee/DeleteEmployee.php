<?php

    namespace GSManager\BLogic\Employee;

    use GSManager\BLogic\AbstractDeleteEntity;
    use GSManager\Domain\Repository\IEmployeeRepository;

    class DeleteEmployee extends AbstractDeleteEntity
    {
        public function __construct(IEmployeeRepository $repository)
        {
            $this->repository = $repository;
        }
    }