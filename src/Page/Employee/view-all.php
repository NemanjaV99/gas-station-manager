<?php

    $session = $this->container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));
    $this->pageSettings->checkAdmin($this->config["UserSettings"]["ADMIN"]);

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
    <?php
     
        $getEmployee = $this->container->get("GetEmployee");
        $result = $getEmployee->get();

        if ($result["success"]) {

            $this->pageSettings->createDisplayDataTable($result);

        } else {

            echo isset($result["error"]) ? $result["error"] : "";
        }


    ?>
</body>
</html>