<?php
namespace Src\Entity;

class ScoreEntity {

    private $username;
    private $timer;

    //SETTERS
    public function getUsername() :String 
    {
        return $this->username;
    }

    public function getTimer() :Int {
        return $this->timer;
    }

    //GETTER
    public function setUsername(String $username) :Void 
    {
        $this->username = $username;
    }

    public function setTimer(Int $timer) :Void 
    {
        $this->timer = $timer;
    }

    public function formatTimer(Int $timer = null) :String 
    {
        $t = $timer;
        $t = floor($t/1000);
        $m = floor($t/60);
        $sec = floor($t-$m*60);
        
        $string = !$m ? $sec." secondes" : $m." minutes et ".$sec." secondes";

        return $string;
    }
}