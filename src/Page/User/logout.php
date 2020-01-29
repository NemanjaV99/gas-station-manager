<?php

    $session = $container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));

    // Code below will execute if session is set
    $session->deleteSession();
    $session->redirect("index.php");