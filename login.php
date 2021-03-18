<!DOCTYPE html>
<!--
Programmer: Tarnue Korvah
Date: 10/16/2019
-->



<?php
//set default value of variables for initial page load
if (!isset($userName)) {
    $userName = '';
}
if (!isset($password)) {
    $password = '';
}
if (!isset($errorMessageLogin)) {
    $errorMessageLogin = '';
}
?> 
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title></title>
    </head>
        <body>
        <header>
            <h1>Capstone Bracket Generator</h1>
        </header>
        <nav>
            <a href="index.php?action=gotoPlayerSearch">Search Players</a>
            <a href="index.php?action=gotoViewTournaments">View Tournaments</a>
            <?php if($_SESSION['user_logged'] != ''){
                echo('<a href="index.php?action=gotoTournamentCreation">Create New Bracket</a>');
                echo('<a href="index.php?action=logout">Logout</a>');
            }else{
                echo('<a href="index.php?action=gotoLogin">Login</a>');
            }
            if($_SESSION['user_logged'] == 'admin'){
                echo('<a href="index.php?action=gotoRegistration">TO Registration</a>');
            }
?>
        </nav>
                <div class='wrapper1'>
                <h1>Login Page</h1>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="login">


                        <div id="login_page">

                            <div class="error"><?php ($errorMessageLogin); ?></div>
                            <br>

                            <label>User Name:</label>
                            <input type="text" name="userName" autofocus
                                   value="<?php ($userName); ?>"> &nbsp; <?php if (!empty($errorMessageUser)) { ?> 
                                <span class="error"><?php ($errorMessageUser); ?></span> <?php } ?>
                            <br>

                            <label>Password:</label>
                            <input type="password" name="password"
                                   value="<?php ($password); ?>"> &nbsp; <?php if (!empty($errorPassword)) { ?> 
                                <span class="error"><?php ($errorPassword); ?></span> <?php } ?>
                            <br>

                            <div id="buttons">
                                <label>&nbsp;</label>
                                <input type="submit" value="Login"><br>

                            </div>
                    </form>
                </div>
    </body>
            
</html>
