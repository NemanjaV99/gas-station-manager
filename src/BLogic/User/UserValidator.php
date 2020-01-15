<?php

    namespace GSManager\BLogic\User;

    use GSManager\BLogic\Validator;

    class UserValidator extends Validator
    {

        public function validateEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
                return true;
            } else {

                $this->error = "Email is not valid.";
                return false;
            }
        }

        public function validateName($name)
        {
            if ($this->checkAlphaChars($name)) {

                return true;

            } else {

                $this->error = "Name/Surname can only contain alphabetic characters.";
                return false;
            }
        }

        public function changeNameCase($name)
        {
            return ucfirst(strtolower($name));
        }

    }