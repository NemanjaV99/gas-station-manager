<?php


    use Psr\Container\ContainerInterface;

    return [

        "Config" => require_once "config.php",

        "DatabaseConfig" => require_once "db.php",

        "Session" => function (ContainerInterface $c) {
            return new \GSManager\Utility\Session();
        },

        /** Business Logic - User */
        "LoginUser" => function (ContainerInterface $c) {
            return new GSManager\BLogic\User\LoginUser(
                $c->get("User"), 
                $c->get("UserDataAccess"), 
                $c->get("UserValidator"));
        },

        "RegisterUser" => function (ContainerInterface $c) {
            return new GSManager\BLogic\User\RegisterUser(
                $c->get("User"), 
                $c->get("UserDataAccess"), 
                $c->get("UserValidator"));
        },

        "UserValidator" => function () {
            return new GSManager\BLogic\User\UserValidator();
        },

        "GetUser" => function (ContainerInterface $c) {
            return new GSManager\BLogic\User\GetUser($c->get("UserDataAccess"));
        },

        /** Business Logic - Employee */
        "GetEmployee" => function (ContainerInterface $c) {
            return new GSManager\BLogic\Employee\GetEmployee($c->get("EmployeeDataAccess"));
        },

        /** Business Logic - Store */
        "GetStock" => function (ContainerInterface $c) {
            return new GSManager\BLogic\Stock\GetStock($c->get("StockDataAccess"));
        },

        /** Entity */
        "User" => function () {
            return new GSManager\Domain\Entity\User();
        },

        "Employee" => function () {
            return new GSManager\Domain\Entity\Employee();
        },

        "Fuel" => function () {
            return new GSManager\Domain\Entity\Fuel();
        },

        "GasStation" => function () {
            return new GSManager\Domain\Entity\GasStation();
        },

        /** Database */
        "DatabaseConnection" => function (ContainerInterface $c) {
            return new GSManager\Database\DatabaseConnection($c->get("DatabaseConfig"));
        },

        /** Data Access*/
        "UserDataAccess" => function (ContainerInterface $c) {
            return new GSManager\Database\User\UserDataAccess($c->get("DatabaseConnection"));
        },

        "EmployeeDataAccess" => function (ContainerInterface $c) {
            return new GSManager\Database\Employee\EmployeeDataAccess($c->get("DatabaseConnection"));
        },

        "StockDataAccess" => function (ContainerInterface $c) {
            return new GSManager\Database\Stock\StockDataAccess($c->get("DatabaseConnection"));
        }

        
    ];