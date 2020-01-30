<?php

    $session = $container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View all employees</title>
</head>
<body>
    <?php
     
        $getEmployee = $container->get("GetEmployee");
        $result = $getEmployee->get();

        if ($result["success"]) {

            // We got the data

            $data = $result["result"];

            echo "<table class='display-data' border=1>";

            // Display headers 
            echo "<tr>";
            foreach ($data[0] as $key => $value) {
                echo "<th>$key</th>";
            }
            echo "</tr>";

            // Display data
            foreach ($data as $array) {

                echo "<tr>";

                foreach ($array as $row) {
                    echo "<td>$row</td>";
                }

                echo "</tr>";
            }

            echo "</table>";


        } else {

            echo isset($result["error"]) ? $result["error"] : "";
        }


    ?>
</body>
</html>