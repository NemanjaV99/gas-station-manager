<?php

    session_start();

    $session = $container->get("Session");
    
    if ($session->exists()) {

        $session->redirect("?page=home&type=user");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
</head>
<body>
    
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
        <input type="submit" name="register" value="Register">
    </form>

</body>
</html>

<?php

    if (isset($_POST["register"])) {

        $registerUser = $container->get("RegisterUser");
        $result = $registerUser->register();

        if ($result["success"]) {

            $user = $result["data"];
            $session->setSession($user);
            $session->redirect("?page=home&type=user");

        } else {

            echo $result["error"];
        }

    }

