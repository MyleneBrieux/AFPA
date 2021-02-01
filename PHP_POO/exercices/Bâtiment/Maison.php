<?php

include_once('Batiment.php');

class Maison extends Batiment {

    private $nbPieces;

    public function __construct(string $newAdresse, float $newSuperficie, int $newNbPieces){
        parent::__construct($newAdresse);
        // $this->setAdresse($newAdresse);
        $this->setSuperficie($newSuperficie);
        $this->nbPieces=$newNbPieces;
    }

    public function presentationMaison():string {
        return "La maison se trouve au " . $this->getAdresse() . ", a une superficie de " . $this->getSuperficie() . "m2 et contient " . $this->nbPieces . " pièces";
    }

    public function getNbPieces():int{
        return $this->nbPieces;
    }

    public function setNbPieces(int $newNbPieces):self{
        $this->nbPieces=$newNbPieces;
        return $this;
    }

    public function __toString():string{
        return "[Adresse]: " . parent::__toString() . " [Superficie]: " . $this->getSuperficie() . " [Nombre de pièces]: " . $this->nbPieces ;
    }
}

?>