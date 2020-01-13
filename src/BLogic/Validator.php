<?php

    namespace GSManager\BLogic;

    abstract class Validator
    {
        protected $errors = [];

        public function getErrors()
        {
            return $this->errors;
        }

        public function checkEmptyInput($input)
        {
            return $input === "" ? false : true;
        }

        public function checkEmptyAllFields($fields)
        {
            foreach ($fields as $field) {

                if (!$this->checkEmptyInput($field)) {

                    $this->errors[] = "All fields must be checked.";
                    return false;
                }
            }

            return true;
        }

        public function checkAlphaChars($input)
        {
            return ctype_alpha($input);
        }
    }