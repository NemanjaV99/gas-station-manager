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
        
            // Display All Employees
            $getEmployee = $this->container->get("GetEmployee");
            $getResult = $getEmployee->get();

            if ($getResult["success"]) {

                $this->pageSettings->createDisplayDataTable($getResult);

            } else {

                if (isset($getResult["error"])) {

                    echo "<div class='error'>" . $getResult["error"] . "</div>";

                } else {

                    echo "<div class='no-result'>No employees in database.</div>";
                }
            }

            echo "<div class='flex-container'>";
            // Create a new Employee
            require_once "../src/Page/Employee/add-new.php";


            if (isset($_POST["new-employee"])) {

                $createEmployee = $this->container->get("CreateEmployee");
                $createResult = $createEmployee->create();

                if ($createResult["success"]) {

                    header("Location: index.php?page=view-all&type=employee");
                    exit();

                } else {

                    echo "<div class='error'>" . $createResult["error"] . "</div>";
                }
            }

            // Delete Employee
            require_once "../src/Page/delete.php";

            if (isset($_POST["submit-delete"])) {

                $deleteEmployee = $this->container->get("DeleteEmployee");
                $deleteResult = $deleteEmployee->delete();

                if ($deleteResult["success"]) {

                    header("Location: index.php?page=view-all&type=employee");
                    exit();

                } else {

                    echo "<div class='error'>" . $deleteResult["error"] . "</div>";
                }
            }
        ?>
        </div><!-- end of flex container -->
    </div>
</body>
</html>