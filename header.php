<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>register php </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<header>

    <nav>
        <div class="main-wrapper">

            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>

            <div class="nav-login">

            <?php

                if(isset($_SESSION['u_uid']))
                {
                    echo '<form action="includes/logout.inc.php" method="POST">
                    <button type="submit" name = "submit">Log out</button>
                    </form>';
                }
                else
                {
                    echo ' <form action = "includes/login.inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username/e-mail">
                    <input type="password" name="pwd" placeholder="password">
                    <button type="submit" name = "submit">Login</button>
                </form>';
                }

            ?>
            

               

                <br>
                <a href="signup.php">Sign up</a>
            </div>

        </div>
    </nav>


</header>
