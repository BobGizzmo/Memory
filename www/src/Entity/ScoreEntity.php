<?php
namespace Src\Entity;

class ScoreEntity {

    private $username;
    private $timer;

    //SETTERS
    public function getUsername() :String {
        return $this->username;
    }

    public function getTimer() :Int {
        return $this->timer;
    }

    //GETTER
    public function setUsername(String $username) {
        $this->username = $username;
    }

    public function setTimer(Int $timer) {
        $this->timer = $timer;
    }
}