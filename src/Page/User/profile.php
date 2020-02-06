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
    <title>User Profile</title>
    <link href="<?php echo $this->pageSettings->getStyle() ?>" rel="stylesheet">
</head>
<body>
    <?php require_once "../src/Page/menu.php"; ?>
    <div class="container">
        <div class="profile">
            <?php

                $getUser = $this->container->get("GetUser");
                $getResult = $getUser->getByID($session->getSessionKey("user"));

                if ($getResult["success"]) {

                    $user = $getResult["result"][0];
                    echo "<h1 class='header-main header'>" . $user["NAME"] . "'s Profile</h1>";

                    // Unset password to not show in result
                    unset($user["PASSWORD"]);

                    // Get the role for custom table data
                    $role = $user["ID ROLE"];
                    unset($user["ID ROLE"]);

                    echo "<table class='display-data'>";

                    foreach($user as $key => $value) {

                        echo "<tr><th>$key</th>";
                        echo "<td>$value</td></tr>";
                    }

                    $role = $this->pageSettings->checkAdmin($this->config["UserSettings"]["ADMIN"]) ? "Admin" : "User";
                    echo "<tr><th>Role</th><td>$role</td></tr>";
                    
                    echo "</table>";

                    // Update profile
                    require_once "../src/Page/User/update.php";

                }

            ?>
        </div>
    </div>
</body>
</html>