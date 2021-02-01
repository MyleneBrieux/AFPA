<?php

include_once('Employe.php');
include_once('Personne.php');

class Professeur extends Employe {

    protected $specialite;
    
    public function __construct(int $newId, string $newNom, string $newPrenom, float $newSalaire, string $newSpecialite){
        parent::__construct($newId, $newNom, $newPrenom, $newSalaire);
        $this->specialite=$newSpecialite;
    }

    public function presentationProfesseur():string {
        return "Je suis " . $this->getNom() . " " . $this->getPrenom() . " mon salaire est : " . $this->getSalaire() . "€ ma spécialité est : " . $this->specialite ;
    }

    public function getSpecialite():string{
        return $this->specialite;
    }

    public function setSpecialite(string $newSpecialite):self{
        $this->specialite=$newSpecialite;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; [Salaire]: " . parent::__toString() . " ; [Spécialité]: " . $this->specialite;
    }

}
?>