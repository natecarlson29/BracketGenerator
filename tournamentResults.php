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
        <title>Brackets - Results</title>
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
                <h3>Bracket Completed.</h3>
                <h1>Results</h1>
                <ol>
                    <li><?php echo($firstPlace) ?></li>
                    <li><?php echo($secondPlace) ?></li>
                    <li><?php echo($thirdPlace) ?></li>
                    <li><?php echo($fourthPlace) ?></li>
                </ol>
            </div>
        <footer>Nate Carlson - Solo Capstone Project</footer>
    </body>
</html>
