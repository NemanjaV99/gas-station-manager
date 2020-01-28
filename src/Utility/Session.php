<?php

    namespace GSManager\Utility;

    class Session
    {
        public function notSet()
        {
            session_start();

            if (!$this->exists()) {
                $this->redirect("?page=login&type=user");
            }
        }

        public function exists()
        {
            return isset($_SESSION["user"]);
        }

        public function redirect($page)
        {
            header("Location: $page");
            exit();
        }

        public function setSession($user)
        {
            $_SESSION["user"] = $user->getID();
        }

        public function deleteSession()
        {
            session_destroy();
        }
    }