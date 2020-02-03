<?php

    namespace GSManager\BLogic\User;

    use GSManager\BLogic\AbstractDeleteEntity;
    use GSManager\Domain\Repository\IUserRepository;

    class DeleteUser extends AbstractDeleteEntity
    {
        public function __construct(IUserRepository $repository)
        {
            $this->repository = $repository;
        }
    }