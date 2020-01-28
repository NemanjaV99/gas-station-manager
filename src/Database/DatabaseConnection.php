<?php

    namespace GSManager\Database;

    use \PDO;
    use \PDOException;

    class DatabaseConnection
    {
        private $dbHost;
        private $dbName;
        private $dbUser;
        private $dbPass;

        private $connection;

        private $dbResponse;

        public function __construct($dbCredentials)
        {
            $this->dbHost = $dbCredentials["DB_HOST"];
            $this->dbName = $dbCredentials["DB_NAME"];
            $this->dbUser = $dbCredentials["DB_USER"];
            $this->dbPass = $dbCredentials["DB_PASS"];
        }

        public function executeQuery($query, $params = [])
        {
            try {

                $this->openConnection();

                $statement = $this->connection->prepare($query);

                if (empty($params)) {

                    $stmtResult = $statement->execute();
                } else {

                    $stmtResult = $statement->execute($params);
                }
    
                if ($stmtResult) {

                    $this->dbResponse["statement"] = $statement;

                } else {

                    $this->dbResponse["db_error"] = true;
                }

            } catch (PDOException $ex) {

                $this->dbResponse["db_error"] = true;
                $this->logErrorFile($ex->getMessage(), $ex->getCode());
            }

            return $this->dbResponse;
        }

        private function openConnection()
        {
            $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
            $this->connection = new PDO($dsn, $this->dbUser, $this->dbPass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        private function logErrorFile($errorMessage, $errorCode)
        {
            $file = fopen("src/Database/db-error-log.txt", "a+");

            $content = "Date: " . date("d.m.Y / h:i:s", time()) . PHP_EOL;
            $content .= "Error Message: " . $errorMessage . PHP_EOL;
            $content .= "Error Code: " . $errorCode . PHP_EOL;
            $content .= "-------------" . PHP_EOL . PHP_EOL;

            fwrite($file, $content);
            fclose($file);
        }

        public function __destruct()
        {
            $this->connection = null;
        }

        public function lastInsertID()
        {
            return $this->connection->lastInsertId();
        }
    }