<?php

class Batiment {

    private $adresse;
    private $superficie;

    public function __construct(string $newAdresse){
        $this->adresse=$newAdresse;
    }

    public function presentationBat():string {
        return "Le bâtiment se trouve au " . $this->adresse ;
    }

    public function getAdresse():string{
        return $this->adresse;
    }

    public function setAdresse(string $newAdresse):self{
        $this->adresse=$newAdresse;
        return $this;
    }

    public function getSuperficie():float{
        return $this->superficie;
    }

    public function setSuperficie(float $newSuperficie):self{
        $this->superficie=$newSuperficie;
        return $this;
    }

    public function __toString():string{
        return " [Adresse] : " . $this->adresse;
    }

}

?>