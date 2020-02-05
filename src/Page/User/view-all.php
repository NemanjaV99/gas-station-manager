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
    <title>View all users</title>
</head>
<body>
    <?php require_once "../src/Page/menu.php"; ?>
    <div class="container">
        <h1 class="header-main header">Users</h1>
        <?php

            $getUser = $this->container->get("GetUser");
            $result = $getUser->get();

            if ($result["success"]) {

                $this->pageSettings->createDisplayDataTable($result);

            } else {

                if (isset($result["error"])) {

                    echo "<div class='error'>" . $result["error"] . "</div>";

                } else {

                    echo "<div class='no-result'>No users in database.</div>";
                }
            }

             // Delete User
             require_once "../src/Page/delete.php";
 
             if (isset($_POST["submit-delete"])) {
 
                 $deleteUser = $this->container->get("DeleteUser");
                 $deleteResult = $deleteUser->delete();
 
                 if ($deleteResult["success"]) {
 
                     header("Location: index.php?page=view-all&type=user");
                     exit();
 
                 } else {
 
                     echo "<div class='error'>" . $deleteResult["error"] . "</div>";
                 }
             }

        ?>
    </div>

</body>
</html>