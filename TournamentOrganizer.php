<?php

class TournamentOrganizer {
    private $username, $password, $playerTag, $city, $tournamentsRan;
    
    function __construct($username, $password, $playerTag, $city) {
        $this->username = $username;
        $this->password = $password;
        $this->playerTag = $playerTag;
        $this->city = $city;
        $this->tournamentsRan = [];
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getPlayerTag() {
        return $this->playerTag;
    }

    function getCity() {
        return $this->city;
    }
    
    function getTournamentsRan() {
        return $this->tournamentsRan;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPlayerTag($playerTag) {
        $this->playerTag = $playerTag;
    }
    
    function setCity($city) {
        $this->city = $city;
    }

    //set using an array as the argument
    function setTournamentsRan($tournamentsRan) {
        $this->tournamentsRan = $tournamentsRan;
    }
    
    function addTournament($tournament) {
        array_push($this->tournamentsRan, $tournament);
    }


    
}
