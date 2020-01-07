<?php
namespace Src\Entity;

class ImagesEntity {

    //Attribut de l'objet
    public $src;
    public $alt;

    //Méthode appelée lors de la construction de l'objet
    public function __construct()
    {}

    //Getter
    public function getSrc() :String 
    {
        return $this->src;
    }

    public function getAlt() :String 
    {
        return $this->alt;
    }

    //Setter
    public function setSrc(String $src) :Void
    {
        $this->src = $src;
    }

    public function setAlt(String $alt) :Void
    {
        $this->alt = $alt;
    }
}