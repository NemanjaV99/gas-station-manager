<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>
</head>
<body>
    
    <form action="#" method="POST" class="form">
        <label for="input-email">Email:</label>
        <input type="text" name="email" class="form__input" id="input-email">
        <label for="input-password">Password:</label>
        <input type="password" name="password" class="form__input" id="input-password">
        <input type="submit" name="login" value="Log In">
    </form>

</body>
</html>

<?php

    if (isset($_POST["login"])) {


        $loginUser = $container->get("LoginUser");
        $result = $loginUser->login();

        if ($result["success"]) {

            var_dump($result);
            echo "Welcome!";

        } else {

            echo $result["error"];
        } 

    }