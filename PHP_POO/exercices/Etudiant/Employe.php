<?php

include_once('Personne.php');

class Employe extends Personne {

    protected $salaire;
    
    public function __construct(int $newId, string $newNom, string $newPrenom, float $newSalaire){
        parent::__construct($newId, $newNom, $newPrenom);
        $this->salaire=$newSalaire;
    }

    public function presentationEmploye():string {
        return "Je suis " . $this->getNom() . " " . $this->getPrenom() . " mon salaire est : " . $this->salaire . "€" ;
    }

    public function getSalaire():float{
        return $this->salaire;
    }

    public function setSalaire(float $newSalaire):self{
        $this->salaire=$newSalaire;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; [Salaire]: " . $this->salaire;
    }

}
?>