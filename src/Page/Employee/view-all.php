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
    <link href="<?php echo $this->pageSettings->getStyle() ?>" rel="stylesheet">
    <title>View all employees</title>
</head>
<body>
    <?php require_once "../src/Page/menu.php"; ?>
    <div class="container">
        <h1 class="header-main header">Employees</h1>
        <?php
        
            $getEmployee = $this->container->get("GetEmployee");
            $result = $getEmployee->get();

            if ($result["success"]) {

                $this->pageSettings->createDisplayDataTable($result);

            } else {

                if (isset($result["error"])) {

                    echo "<div class='error'>" . $result["error"] . "</div>";

                } else {

                    echo "<div class='no-result'>No employees in database.</div>";
                }
            }
        ?>
    </div>
</body>
</html>