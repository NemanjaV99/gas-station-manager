<?php

    $session = $container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gas Station Manager</title>
</head>
<body>
    <h1>Homepage</h1>
    <a href="index.php?page=login&type=user">Login</a>
    <a href="index.php?page=register&type=user">Register</a>
</body>
</html>