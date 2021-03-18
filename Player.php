<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Player
 *
 * @author Nate
 */
class Player {
    private $playerTag, $tournamentIDs, $placings;
    
    function __construct($playerTag, $tournamentIDs, $placings) {
        $this->playerTag = $playerTag;
        $this->tournamentIDs = $tournamentIDs;
        $this->placings = $placings;
    }
    function getPlayerTag() {
        return $this->playerTag;
    }

    function getTournamentIDs() {
        return $this->tournamentIDs;
    }

    function getPlacings() {
        return $this->placings;
    }

    function setPlayerTag($playerTag) {
        $this->playerTag = $playerTag;
    }

    function setTournamentIDs($tournamentIDs) {
        $this->tournamentIDs = $tournamentIDs;
    }

    function setPlacings($placings) {
        $this->placings = $placings;
    }

    function addTournamentID($ID) {
        $this->tournamentIDs += $ID;
    }
    
    function addPlacing($placing) {
        $this->placings += $placing;
    }
}