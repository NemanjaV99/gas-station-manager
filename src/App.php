<?php

    namespace GSManager;

    class App
    {

        private $config;

        public function __construct($config)
        {
            $this->config = $config;
        }

        public function start()
        {
            $this->loadPage();
        }

        private function loadPage()
        {
            if (isset($_GET["page"], $_GET["type"])) {

                $page = strtolower($_GET["page"]);
                $pageType = ucfirst(strtolower($_GET["type"]));

                if (
                    array_key_exists($pageType, $this->config["Page"])
                    && array_key_exists($page, $this->config["Page"][$pageType]) 
                ) {

                    require_once $this->config["Page"][$pageType][$page];

                } else {

                    // 404 error
                    require_once $this->config["Page"]["Default"];
                }
                    
             } else {

                require_once $this->config["Page"]["Default"];
             }
        }
    }