<?php

    $session = $container->get("Session");
    $session->notSet();

    // Code below will execute if session is set
    $session->deleteSession();
    $session->redirect("index.php");