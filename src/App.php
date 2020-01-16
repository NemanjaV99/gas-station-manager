<?php

    namespace GSManager;

    use Psr\Container\ContainerInterface;

    class App
    {

        private $config;
        private $container;

        public function __construct($config, $container)
        {
            $this->config = $config;
            $this->container = $container;
        }

        public function start()
        {
            $this->loadPage();
        }

        private function loadPage()
        {
            // This will be used by the loaded pages 
            $container = $this->container;

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