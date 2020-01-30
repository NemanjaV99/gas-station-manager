<?php

    require_once "vendor/autoload.php";
    $dependencies = require_once "config/dependencies.php";

    $containerBuilder = new DI\ContainerBuilder();
    $containerBuilder->addDefinitions($dependencies);
    $container = $containerBuilder->build();

    $app = $container->get("App");
    $app->setContainer($container);
    $app->start();
