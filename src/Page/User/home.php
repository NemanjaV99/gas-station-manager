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
    <title>Home</title>
</head>
<body>
    <h1>User Home</h1>
    <a href="index.php?page=logout&type=user">Log out</a>
    <a href="index.php?page=view-all&type=user">View all users</a>
</body>
</html>