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
        <title>Brackets - Tournament Creation</title>
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
                <input type="hidden" name="action" value="createTournamentSubmission">
                Game Played:<br>
                    <select name="game">
                        <option value="Smash_Bros_Melee" selected>Super Smash Bros Melee</option> 
                        <option value="Street_Fighter_3">Street Fighter 3</option>
                        <?php foreach($allGames as $game){ $gameValue = str_replace(' ', '_', $game); echo('<option value=' . $gameValue . '>' . $game . '</option>');} ?>
                    </select>
                    Game not listed? Type a new game and add it to the list <input type="text" name="newGame"><input type="submit" name="addNewGame" value="Add"><br>
                    <br><?php if(isset($newGameError)){echo($newGameError);} ?><br>
                    City of the Tournament:
                    <input type="text" name="city" value="<?php if(isset($city)){echo($city);}?>"><br>
                    Name of the Tournament:
                    <input type="text" name="tournamentName" value="<?php if(isset($tournamentName)){echo($tournamentName);}?>"><br>
                    Amount of players (round up):
                        <select name="entrantCap">
                            <option value="8" selected>8</option> 
                            <option value="16">16</option>
                            <option value="32">32</option>
                            <option value="64">64</option>
                            <option value="128">128</option>
                        </select> <br>
                    <input type="submit" value="Continue">
                
            </form> 
        </div>
        <footer>Nate Carlson - Solo Capstone Project</footer>
    </body>
</html>
