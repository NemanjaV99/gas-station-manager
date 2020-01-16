<?php

    use GSManager\App;

    require_once "vendor/autoload.php";
    $config = require_once "config/config.php";
    $dependencies = require_once "config/dependencies.php";

    $containerBuilder = new DI\ContainerBuilder();
    $containerBuilder->addDefinitions($dependencies);
    $container = $containerBuilder->build();

    $app = new App($config, $container);
    $app->start();
