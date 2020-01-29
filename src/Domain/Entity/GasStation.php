<?php

    namespace GSManager\Domain\Entity;

    class GasStation
    {
        private $id;
        private $name;

        public function getID()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setID($id)
        {
            $this->id = $id;
        }

        public function setName($name)
        {
            $this->name = $name;
        }
    }