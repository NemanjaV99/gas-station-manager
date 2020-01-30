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
    <title>Register User</title>
</head>
<body>
    <div class="menu">
        <a class="link" href="index.php?page=login&type=user">Login</a>
        <a class="link" href="index.php?page=register&type=user">Register</a>
    </div>
    <div class="container">
    <h1 class="header-main header">Register</h1>
    <form action="#" method="POST" class="form">
        <label for="input-name">Name:</label>
        <input type="text" name="name" class="form__input" id="input-name">
        <label for="input-lname">Last name:</label>
        <input type="text" name="surname" class="form__input" id="input-lname">
        <label for="input-email">Email:</label>
        <input type="text" name="email" class="form__input" id="input-email">
        <label for="input-password">Password:</label>
        <input type="password" name="password" class="form__input form__input--pass" id="input-password">
        <label for="input-gstation">Gas Station:</label>
        <select name="gstation" id="input-gstation" class="form__select">
            <option value="1">Pumpa A</option>
            <option value="2">Pumpa B</option>
            <option value="3">Pumpa C</option>
        </select>
        <input type="submit" name="register" value="Register" class="form__input">
    </form>
        
        <?php

        if (isset($_POST["register"])) {

            $registerUser = $this->container->get("RegisterUser");
            $result = $registerUser->register();

            if ($result["success"]) {

                $user = $result["data"];
                $session->setSession($user);
                $session->redirect("?page=home&type=user");

            } else {

                echo "<div class='error'>" . $result["error"] . "</div>";
            }

        }
    ?>

    </div>

</body>
</html>


