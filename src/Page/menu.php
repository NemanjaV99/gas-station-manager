<div class="menu">

    <?php

        if ($this->pageSettings->checkAdmin($this->config["UserSettings"]["ADMIN"])) {

            // If user is admin he can see links for these pages

            echo "<a class='link' href='index.php?page=view-all&type=user'>Users</a>";
            echo "<a class='link' href='index.php?page=view-all&type=employee'>Employees</a>";
        }

    ?>
    <a class="link" href="index.php?page=view-all&type=stock">Stock</a>
    <a class="link" href="index.php?page=profile&type=user">Profile</a>
    <a class="link" href="index.php?page=logout&type=user">Log out</a>

</div>