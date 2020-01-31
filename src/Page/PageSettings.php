<?php

    namespace GSManager\Page;

    class PageSettings
    {

        const STYLE = "public/css/style.css";

        public function getStyle()
        {
            return self::STYLE;
        }

        public function createDisplayDataTable($result)
        {
            // We got the data

            $data = $result["result"];

            echo "<table class='display-data'>";

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
        }

        public function checkAdmin($admin)
        {
            if (isset($_SESSION["user"])) {

                return $_SESSION["role"] == $admin;
            }
        }

    }