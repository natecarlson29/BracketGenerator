<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tournament
 *
 * @author Nate
 */
class Tournament {
    private $tournamentName, $tournamentCity, $tournamentOrganizers, $dateHappened, $entrantCap, $gameName, $entrants, $results;
    
    function __construct($tournamentName, $tournamentCity, $tournamentOrganizers, $dateHappened, $entrantCap, $gameName, $results) {
        $this->tournamentName = $tournamentName;
        $this->tournamentCity = $tournamentCity;
        $this->tournamentOrganizers = $tournamentOrganizers;
        $this->dateHappened = $dateHappened;
        $this->entrantCap = $entrantCap;
        $this->gameName = $gameName;
        $this->entrants = [];
        $this->results = $results;
    }
    function getGameName() {
        return $this->gameName;
    }

    function getEntrants() {
        return $this->entrants;
    }

    function setGameName($gameName) {
        $this->gameName = $gameName;
    }

    function setEntrants($entrants) {
        $this->entrants = $entrants;
    }

    function getTournamentName() {
        return $this->tournamentName;
    }

    function getTournamentCity() {
        return $this->tournamentCity;
    }

    function getTournamentOrganizers() {
        return $this->tournamentOrganizers;
    }

    function getDateHappened() {
        return $this->dateHappened;
    }

    function getEntrantCap() {
        return $this->entrantCap;
    }

    function getResults() {
        return $this->results;
    }

    function setTournamentName($tournamentName) {
        $this->tournamentName = $tournamentName;
    }

    function setTournamentCity($tournamentCity) {
        $this->tournamentCity = $tournamentCity;
    }

    function setTournamentOrganizers($tournamentOrganizers) {
        $this->tournamentOrganizers = $tournamentOrganizers;
    }

    function setDateHappened($dateHappened) {
        $this->dateHappened = $dateHappened;
    }

    function setEntrantCap($entrantCap) {
        $this->entrantCap = $entrantCap;
    }

    function setResults($results) {
        $this->results = $results;
    }
    
    function getTotalEntrants() {
        $entrantArray = $this->entrants();
        $entrantCount = 0;
        foreach($entrantArray as $entrant){
            if($entrant != '<i>Bye</i>'){
                $entrantCount++;
            }
        }
        return $entrantCount;
    }

    function addEntrant($entrant) {
        array_push($this->entrants, $entrant);
    }
}
