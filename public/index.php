<?php

    require_once dirname(__DIR__) . "/vendor/autoload.php";
    $dependencies = require_once dirname(__DIR__) . "/config/dependencies.php";

    $containerBuilder = new DI\ContainerBuilder();
    $containerBuilder->addDefinitions($dependencies);
    $container = $containerBuilder->build();

    $app = $container->get("App");
    $app->setContainer($container);
    $app->start();
