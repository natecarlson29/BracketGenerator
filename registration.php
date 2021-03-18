<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Registration</title>
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
                    <h2>Tournament Organizer Registration</h2>
                    <form action="index.php" method="post">
                        
                        <label>Username: </label>
                        <input type="text" name="username" value='<?php if (!empty($username)){  xecho ($username); } ?>'/>
                        <?php if (!empty($userNameError)){  xecho ($userNameError); } ?>
                        <br>
                        <label>Password: </label>
                        <input type="text" name="password" value='<?php if (!empty($password)){  xecho ($password); } ?>'/>
                        <?php if (!empty($passwordError)){  xecho ($passwordError); } ?>
                        <br>
                        <label>Player Tag: </label>
                        <input type="text" name="playerTag" value='<?php if (!empty($playerTag)){  xecho ($playerTag); } ?>'/>
                        <?php if (!empty($playerTagError)){  xecho ($playerTagError); } ?>
                        <br>
                        <label>City you're from: </label>
                        <input type="text" name="city" value='<?php if (!empty($city)){  xecho ($city); } ?>'/>
                        <?php if (!empty($cityError)){  xecho ($cityError); } ?>
                        <br>
                        <input type="hidden" name="action" value="register">

                        <input type="submit" value="GO" />
                        
                    </form>
            </div>
    </body>
</html>
