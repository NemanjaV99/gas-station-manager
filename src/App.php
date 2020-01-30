<?php

    namespace GSManager;

    use GSManager\Page\PageSettings;

    class App
    {
        private $config;
        private $container;
        private $pageSettings;

        public function __construct($config, PageSettings $pageSettings)
        {
            $this->config = $config;
            $this->pageSettings = $pageSettings;
        }

        public function start()
        {
            $this->loadPage();
        }

        public function setContainer($container)
        {
            $this->container = $container;
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