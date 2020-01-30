<?php

    $session = $this->container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo $this->pageSettings->getStyle() ?>" rel="stylesheet">
    <title>Gas Station Manager</title>
</head>
<body>
    <div class="menu">
        <a class="link" href="index.php?page=login&type=user">Login</a>
        <a class="link" href="index.php?page=register&type=user">Register</a>
    </div>
    <div class="container">
        <h1 class="header-main header">Homepage</h1>
        <p>Welcome to Gas Station manager. To continue please <a class="link" href="index.php?page=register&type=user">Register</a>, or if you already have an account, <a class="link" href="index.php?page=login&type=user">Log in</a></p>
    </div>
</body>
</html>