<?php

class Voiture {

    public $marque;
    public $modele;

    public function __construct(string $marque, string $modele){
        $this->marque=$marque;
        $this->modele=$modele;
    }

    public function getMarque():string{
        return $this->marque;
    }

    public function setMarque(string $marque):self{
        $this->marque=$marque;
        return $this;
    }

    public function getModele():string{
        return $this->modele;
    }

    public function setModele(string $modele):self{
        $this->modele=$modele;
        return $this;
    }

    public function __toString():string{
        return " [Marque] : " . $this->marque . " [Modèle] : " . $this->modele ;
    }
}

?>