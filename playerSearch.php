<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Brackets - Player Search</title>
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
                <form action="index.php" method="post">
                    <label>Search a player</label>
                    <input type="text" name="playerTag" value="<?php if(isset($oldSearch)){echo($oldSearch);} ?>"><br>
                    <input type="hidden" name="action" value="searchPlayer"><br>
                    <input type="submit" value="Search">
                </form>
                    <?php foreach($searchedList as $player){echo('<a href=index.php?action=gotoPlayer&playerTag=' . $player . '>' . $player . '</a><br>');} ?>
                
            </div>
        <footer>Nate Carlson - Solo Capstone Project</footer>
    </body>
</html>
