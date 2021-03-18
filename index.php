<?php

//template with old code to use for new program ************************************************************

require_once('database.php');
require_once('TournamentOrganizer.php');
require_once('Tournament.php');
require_once('UserDB.php');
require_once('Player.php');

session_start();

if (!isset($_SESSION['user_logged'])) {
    $_SESSION['user_logged'] = '';
}

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == null) {
        $action = 'gotoHome';
    }
}

if(isset($_POST['addNewGame'])){
    $action = 'addNewGame';
}

function xssafe($data,$encoding='UTF-8'){
   return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
}

function xecho($data){
   echo xssafe($data);
}

switch ($action) {
    case 'register':
        include('registrationConfirmation.php');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $playerTag = filter_input(INPUT_POST, 'playerTag');
        $city = filter_input(INPUT_POST, 'city');
        $options = [
            //DO set a cost factor, experiment to find a number that is sufficiently high but doesn't kill your performance
            'cost' => 12
                //DON'T supply your own salt like this, let password_hash do that for you
                //'salt' => "notgoodnotgoodnotgoodnotgoodnotgood",
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $TO = new TournamentOrganizer($username, $hashedPassword, $playerTag, $city);
        UserDB::addTO($TO);
        $_SESSION['user_logged'] = $username;
        include('login.php');
        die();
        break;
    case 'login':
        include('loginConfirmation.php');
        include('home.php');
        die();
        break;
    case 'searchPlayer':
        $oldSearch = filter_input(INPUT_POST, 'playerTag');
        $searchedList = UserDB::getPlayerBySearch($oldSearch);
        include 'playerSearch.php';
        die();
        break;
    case 'addNewGame':
        $newGameError = '';
        $newGame = filter_input(INPUT_POST, 'newGame');
        $city = filter_input(INPUT_POST, 'city');
        $tournamentName = filter_input(INPUT_POST, 'tournamentName');
        if(isset($newGame)){
            UserDB::addGame($newGame);
            $newGameError = 'Game was successfully added';
        }else{
            $newGameError = 'You must enter a name to add it to the list';
        }
        $allGames = UserDB::getAllGames();
        $_POST['addNewGame'] = '';
        include 'tournamentCreation.php';
        die();
        break;
    case 'createTournamentSubmission':
        $tournamentName = filter_input(INPUT_POST, 'tournamentName');
        $tournamentCity = filter_input(INPUT_POST, 'city');
        $tournamentOrganizers = $_SESSION['user_logged'];
        $gameName = filter_input(INPUT_POST, 'game');
        $dateHappened = strval(date("Y-m-d"));
        $entrantCap = filter_input(INPUT_POST, 'entrantCap');
        if(isset($tournamentName) || isset($tournamentCity)){
            $tournamentObject = new Tournament($tournamentName, $tournamentCity, $tournamentOrganizers, $dateHappened, $entrantCap, $gameName, null);
            $_SESSION['currentTourney'] = $tournamentObject;
            UserDB::addTournament($tournamentObject);
            include 'tournamentCreationPlayers.php';
        }else{
            $newGameError = 'Please fill out all of the information to continue.';
            include 'tournamentCreation.php';
        }
        die();
        break;
    case 'submitPlayers':
        $entrantCap = $_SESSION['currentTourney']->getEntrantCap();
        for($x=0; $x<$entrantCap; $x++){
            $currentTextbox = filter_input(INPUT_POST, 'index'.$x);
            if($currentTextbox!=''){
                $_SESSION['currentTourney']->addEntrant($currentTextbox);
                if(!UserDB::playerExists($currentTextbox)){
                    UserDB::addPlayer($currentTextbox);
                }
            }else{
                $_SESSION['currentTourney']->addEntrant(NULL);
            }
            
            
        }
        include 'editableBracket.php';
        die();
        break;
    case 'logout':
        $_SESSION['user_logged'] = NULL;
        include 'home.php';
        die();
        break;
    case 'gotoPlayer':
        $playerClicked = filter_input(INPUT_GET, 'playerTag');
        $playerObject = UserDB::getPlayer($playerClicked);
        $tournamentIDsArray = explode(" ", $playerObject->getTournamentIDs());
        $placingsArray = explode(" ", $playerObject->getPlacings());
        include 'playerProfile.php';
        die();
        break;
    case 'gotoResults':
        $tourneyName = str_replace(" ", "_", $_SESSION['currentTourney']->getTournamentName());
        $firstPlace = filter_input(INPUT_GET, 'first');
        $secondPlace = filter_input(INPUT_GET, 'second');
        $thirdPlace = filter_input(INPUT_GET, 'third');
        $fourthPlace = filter_input(INPUT_GET, 'fourth');
        UserDB::updatePlacings($firstPlace, $tourneyName, '1st');
        UserDB::updatePlacings($secondPlace, $tourneyName, '2nd');
        UserDB::updatePlacings($thirdPlace, $tourneyName, '3rd');
        UserDB::updatePlacings($fourthPlace, $tourneyName, '4th');
        $resultsString = '1st: '.$firstPlace.' | 2nd: '.$secondPlace.' | 3rd: '.$thirdPlace.' | 4th: '.$fourthPlace;
        UserDB::updateResults($_SESSION['currentTourney']->getTournamentName(), $resultsString);
        $entrants = $_SESSION['currentTourney']->getEntrants();
        foreach($entrants as $entrant){
            if($entrant != $firstPlace && $entrant != $secondPlace && $entrant != $thirdPlace && $entrant != $fourthPlace ){
                UserDB::updatePlacings($entrant, $tourneyName, 'Not_Placed');
            }
        }
        
        include 'tournamentResults.php';
        die();
        break;
        
        
        
        
        
        
    //NAVIGATION
    
    case 'gotoHome':
        include('home.php');
        die();
        break;
    case 'gotoRegistration':
        include 'registration.php';
        die();
        break;
    case 'gotoLogin':
        include 'login.php';
        die();
        break;
    case 'gotoPlayerSearch':
        $searchedList = UserDB::getAllPlayers();
        include 'playerSearch.php';
        die();
        break;
    case 'gotoTournamentCreation':
        $allGames = UserDB::getAllGames();
        include 'tournamentCreation.php';
        die();
        break;
    case 'gotoViewTournaments':
        $allTournaments = UserDB::getAllTournaments();
        include 'viewTournaments.php';
        die();
        break;
        
        
        
        
        
        
    //old/example code below -------------- code being used above
    /*case 'gotoNewFoodEntry':
        $currentUser = $_SESSION['user_logged'];
        $foods = dbMethods::getDefaultFoods();
        include 'newFoodEntry.php';
        die();
        break;
    case 'gotoAddNewFood':
        include 'addNewFood.php';
        die();
        break;
    case 'gotoHome':
        $currentUser = $_SESSION['user_logged'];
        include "home.php";
        die();
        break;
    case 'deleteLog':
        $logsID = filter_input(INPUT_POST, 'logsID');
        dbMethods::deleteLog($logsID);
        $currentUser = $_SESSION['user_logged'];
        $logs = dbMethods::getLog($currentUser);
        include 'home.php';
        die();
        break;
    case 'addEntry':
        include('entryConfirmation.php');
        $currentUser = $_SESSION['user_logged'];
        dbMethods::addEntry($currentUser, $foodID, $date);
        $logs = dbMethods::getLog($currentUser);
        include('home.php');
        die();
        break;
    case 'addTempFood':
        include('entryConfirmationTemp.php');
        $currentUser = $_SESSION['user_logged'];
        dbMethods::addFood($foodName, $calories, $protein, $currentUser);
        $foods = dbMethods::getAvailableFoods($currentUser);
        $foodID = end($foods)->getFoodID();
        dbMethods::addEntry($currentUser, $foodID, $date);
        $logs = dbMethods::getLog($currentUser);
        include('home.php');
        die();
        break;
    case 'addFood':
        include('foodConfirmation.php');
        $currentUser = $_SESSION['user_logged'];
        dbMethods::addFood($foodName, $calories, $protein, $currentUser);
        $logs = dbMethods::getLog($currentUser);
        include('home.php');
        die();
        break;*/
}
