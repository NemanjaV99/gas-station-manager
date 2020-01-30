<?php

    namespace GSManager\Utility;

    class Session
    {

        public function checkSessionAndRedirect($currentPage)
        {
            session_start();

            if ($this->exists()) {

                switch ($currentPage) {

                    case "login":
                    case "register":
                    case "intro":
                        $this->redirect("?page=home&type=user");
                        break;
                    default:
                        "";
                }

            } else {

                switch ($currentPage) {

                    case "login":
                    case "register":
                    case "intro":
                        "";
                        break;
                    default:
                        $this->redirect("?page=login&type=user");
                }
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
            $_SESSION["email"] = $user->getEmail();
            $_SESSION["role"] = $user->getRole();
        }

        public function deleteSession()
        {
            session_destroy();
        }
    }