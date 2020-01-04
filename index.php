<?php

    use GSManager\App;

    require_once "vendor/autoload.php";
    $config = require_once "config/config.php";

    $app = new App($config);
    $app->start();