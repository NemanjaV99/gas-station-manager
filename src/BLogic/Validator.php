<?php

    namespace GSManager\BLogic;

    abstract class Validator
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

        public function checkAlphaChars($input)
        {
            return ctype_alpha($input);
        }
    }