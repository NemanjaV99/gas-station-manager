<?php

    namespace GSManager\BLogic;

    class Validator
    {
        protected $error;

        public function getError()
        {
            return $this->error;
        }

        public function checkEmptyInput($input)
        {
            return $input === "" ? false : true;
        }

        public function checkEmptyAllFields($fields)
        {
            foreach ($fields as $field) {

                if (!$this->checkEmptyInput($field)) {

                    $this->error = "All fields must be checked.";
                    return false;
                }
            }

            return true;
        }

        public function trimAllFields($fields)
        {
            $trimedFields = [];

            foreach ($fields as $key => $value) {

                $trimedFields[$key] = trim($value);
            }

            return $trimedFields;
        }

        public function checkAlphaChars($input)
        {
            return ctype_alpha($input);
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

        public function validateEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
                return true;
            } else {

                $this->error = "Email is not valid.";
                return false;
            }
        }

        public function changeNameCase($name)
        {
            return ucfirst(strtolower($name));
        }
    }