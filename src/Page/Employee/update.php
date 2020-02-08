<?php

    $session = $this->container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));
    
    if (!$this->pageSettings->checkAdmin($this->config["UserSettings"]["ADMIN"])) {

        // If true, it means that user is admin.
        // Otherwise it means he is not, so he can't access this page.
        header("Location: index.php?page=home&type=user");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Employee - AJAX</title>
    <link href="<?php echo $this->pageSettings->getStyle() ?>" rel="stylesheet">
    <script src="js/main.js"></script>
</head>
<body onload="getData();">
    <?php require_once "../src/Page/menu.php"; ?>
    <div class="container">
        <?php require_once "../src/Page/Employee/update-form.php"; ?>
    </div>
</body>
</html>