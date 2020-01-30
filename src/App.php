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

            $basePath = dirname(__DIR__);

            if (isset($_GET["page"], $_GET["type"])) {

                $page = strtolower($_GET["page"]);
                $pageType = ucfirst(strtolower($_GET["type"]));

                if (
                    array_key_exists($pageType, $this->config["Page"])
                    && array_key_exists($page, $this->config["Page"][$pageType]) 
                ) {

                    require_once $basePath . DIRECTORY_SEPARATOR . $this->config["Page"][$pageType][$page];

                } else {

                    // 404 error
                    require_once $basePath . DIRECTORY_SEPARATOR . $this->config["Page"]["404"];
                }
                    
             } else {

                require_once $basePath . DIRECTORY_SEPARATOR . $this->config["Page"]["Default"];
             }
        }
    }