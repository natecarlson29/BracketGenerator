<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserDB {
    //put your code here

    
    
    public static function isUniqueUsername($username) {
        $db = Database::getDB();
        $query = 'SELECT UserName FROM TournamentOrganizers WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $existing = $statement->fetchAll();
        if ($existing === array()) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function addTO($to) {
        $db = Database::getDB();

        $username = $to->getUserName();
        $password = $to->getPassword();
        $playerTag = $to->getPlayerTag();
        $city = $to->getCity();

        $query = 'INSERT INTO TournamentOrganizers
                 (username, password, playerTag, city)
              VALUES
                 (:username, :password, :playerTag, :city)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':playerTag', $playerTag);
        $statement->bindValue(':city', $city);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getTO($username) {
        $db = Database::getDB();

        $query = 'SELECT * FROM TournamentOrganizers WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $r = $statement->fetch();
        $statement->closeCursor();

        $to = new TournamentOrganizer($r['username'], $r['password'], $r['playerTag'], $r['city']);
        return $to;
    }
    
    public static function getAllPlayers() {
        $db = Database::getDB();
        $query = 'SELECT * FROM players';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $allPlayers = array();
        foreach ($results as $row) {
            $allPlayers[] = $row['playerTag'];
        }
        return $allPlayers;
    }
    
    public static function getPlayerBySearch($search) {
        $search = '%'.$search.'%';
        $db = Database::getDB();
        $query = 'SELECT * FROM players WHERE playerTag like :search';
        $statement = $db->prepare($query);
        $statement->bindValue(':search', $search);
        $statement->execute();
        $results = $statement->fetchAll();
        $players = array();
        foreach ($results as $row) {
            $players[] = $row['playerTag'];
        }
        return $players;
    }
    
    public static function addGame($game) {
        $db = Database::getDB();

        $query = 'INSERT INTO games
                 (gameName)
              VALUES
                 (:game)';
        $statement = $db->prepare($query);
        $statement->bindValue(':game', $game);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getAllGames() {
        $db = Database::getDB();
        $query = 'SELECT * FROM games';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $allGames = array();
        foreach ($results as $row) {
            $allGames[] = $row['gameName'];
        }
        return $allGames;
    }
    
    public static function addTournament($tournament) {
        $db = Database::getDB();

        $tournamentName = $tournament->getTournamentName();
        $tournamentCity = $tournament->getTournamentCity();
        $tournamentOrganizers = $tournament->getTournamentOrganizers();
        $dateHappened = $tournament->getDateHappened();
        $entrantCap = $tournament->getEntrantCap();
        $gameName = $tournament->getGameName();

        $query = 'INSERT INTO Tournaments
                 (tournamentName, tournamentCity, tournamentOrganizers, dateHappened, entrantCap, gameName)
              VALUES
                 (:tournamentName, :tournamentCity, :tournamentOrganizers, :dateHappened, :entrantCap, :gameName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':tournamentName', $tournamentName);
        $statement->bindValue(':tournamentCity', $tournamentCity);
        $statement->bindValue(':tournamentOrganizers', $tournamentOrganizers);
        $statement->bindValue(':dateHappened', $dateHappened);
        $statement->bindValue(':entrantCap', $entrantCap);
        $statement->bindValue(':gameName', $gameName);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getAllTournaments() {
            $db = Database::getDB();
            $query = 'SELECT * FROM tournaments order by dateHappened';
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $allTourneys = array();
            foreach ($results as $row) {
                $tournament = new Tournament($row['tournamentName'], $row['tournamentCity'], $row['tournamentOrganizers'], $row['dateHappened'], $row['entrantCap'], $row['gameName'], $row['results']);
                $allTourneys[] = $tournament;
            }
            return $allTourneys;
        }
        
    public static function playerExists($playerName) {
        $db = Database::getDB();
        $query = 'SELECT * FROM players WHERE playerTag = :playerName';
        $statement = $db->prepare($query);
        $statement->bindValue(':playerName', $playerName);
        $statement->execute();
        $existing = $statement->fetchAll();
        if ($existing === array()) {
            return false;
        } else {
            return true;
        }
    }
        
    public static function addPlayer($playerTag) {
        $db = Database::getDB();
        $query = 'INSERT INTO players
                 (playerTag, tournamentIDs, placings)
              VALUES
                 (:playerTag, \' \', \' \')';
        $statement = $db->prepare($query);
        $statement->bindValue(':playerTag', $playerTag);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getPlayer($playerTag) {
            $db = Database::getDB();
            $query = 'SELECT * FROM players where playerTag = :playerTag';
            $statement = $db->prepare($query);
            $statement->bindValue(':playerTag', $playerTag);
            $statement->execute();
            $results = $statement->fetchAll();
            foreach ($results as $row) {
                $player = new Player($row['playerTag'], $row['tournamentIDs'], $row['placings']);
            }
            return $player;
        }
    
    public static function updatePlacings($playerTag, $tournamentID, $placing)
    {
        $db = Database::getDB();
        
        $query = 'UPDATE players
                SET tournamentIDs = CONCAT(tournamentIDs, :tournamentID), placings = CONCAT(placings, :placing)
                WHERE playerTag = :playerTag';
        
        $statement = $db->prepare($query);
        $statement->bindValue(':playerTag', $playerTag);
        $statement->bindValue(':tournamentID', ' '.$tournamentID);
        $statement->bindValue(':placing', ' '.$placing);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function updateResults($tournamentName, $resultsString)
    {
        $db = Database::getDB();
        
        $query = 'UPDATE tournaments
                SET results = :resultsString
                WHERE tournamentName = :tournamentName';
        
        $statement = $db->prepare($query);
        $statement->bindValue(':resultsString', $resultsString);
        $statement->bindValue(':tournamentName', $tournamentName);
        $statement->execute();
        $statement->closeCursor();
    }
    
    
    
    
    
    
    
    
    //OLD SHIT
    
    
    
    
    public static function select_all() {
        $db = Database::getDB();

        $query = 'SELECT * FROM users ORDER BY lastName';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();


        $users = array();
        foreach ($results as $row) {
            $user = new User($row['username'], $row['password'], $row['role']);
            $users[] = $user;
        }
        return $users;
    }

    public static function getUser($username) {
        $db = Database::getDB();

        $query = 'SELECT * FROM users WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $r = $statement->fetch();
        $statement->closeCursor();

        $user = new User($r['username'], $r['password'], $r['role']);
        return $user;
    }

    public static function checkUsername($username) {
        $db = Database::getDB();

        $query = 'SELECT * FROM users WHERE username=:username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $userOne = $statement->fetch();
        $statement->closeCursor();

        $user_name = $userOne['username'];

        return $user_name;
    }

    public static function checkEmail($role) {
        $db = Database::getDB();
        $query = 'SELECT * FROM users WHERE role=:role';
        $statement = $db->prepare($query);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $uRole = $statement->fetch();
        $statement->closeCursor();

        $user_role = $uRole['role'];

        return $user_role;
    }

    public static function addUser($user) {
        $db = Database::getDB();

        $username = $user->getUserName();
        $password = $user->getPassword();
        $role = $user->getRole();

        $query = 'INSERT INTO users
                 (username, password, role)
              VALUES
                 (:username, :password, :role)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function addAccount($username, $accountName) {
        $db = Database::getDB();

        $query = 'INSERT IGNORE INTO accounts
                 (username, accountName)
              VALUES
                 (:username, :accountName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':accountName', $accountName);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function deleteAccount($username, $accountName) {
        $db = Database::getDB();
        
        $query = 'DELETE FROM accounts
                  WHERE username = :username AND accountName = :accountName';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':accountName', $accountName);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getAccounts($username) {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT * FROM accounts WHERE username=:username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $results = $statement->fetchAll();
        //$statement->closeCursor();
        $accounts = array();
        foreach ($results as $row) {
            $accounts[] = $row['accountName'];
        }
        return $accounts;
    }

    public static function checkPassword($username) {
        $db = Database::getDB();
        $query = 'SELECT * FROM users WHERE username=:username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $passwordOne = $statement->fetch();
        $statement->closeCursor();

        $user_password = $passwordOne['password'];

        return $user_password;
    }
    

    
    public static function updatePassword($username, $password)
    {
        $db = Database::getDB();
        
        $query = 'UPDATE users
                SET password = :password
                WHERE username = :username';
        
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $statement->closeCursor();
    }
    
    
    
    public static function updateRole($username, $role) {
        $db = Database::getDB();
        
        $query = 'UPDATE users
                SET role = :role
                WHERE username = :username';
        
        $statement = $db->prepare($query);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $statement->closeCursor();
    }
}

/* 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
