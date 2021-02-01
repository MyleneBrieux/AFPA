<?php

include_once('Personne.php');

class Developpeur extends Personne {

    private $specialite;

    public function __construct(int $newId, string $newNom, string $newPrenom, string $newMail, string $newTelephone, float $newSalaire, string $newSpecialite){
        parent::__construct($newId, $newNom, $newPrenom, $newMail, $newTelephone, $newSalaire);
        $this->specialite=$newSpecialite;
    }

    public function afficher():string{
        return "Le salaire du développeur " . $this->nom . " " . $this->prenom . " est : " . $this->calculerSalaire() . " €, sa spécialité : " . 
                $this->specialite;
    }

    public function calculerSalaire():float{
        return $this->salaire*1.2;
    }

    public function getSpecialite():string{
        return $this->specialite;
    }

    public function setSpecialite(string $newSpecialite):self{
        $this->specialite=$newSpecialite;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; 
        [Mail]: " . parent::__toString() . " ; [Téléphone]: " . parent::__toString() . " ; [Salaire]: " . parent::__toString() . " ; 
        [Counter]: " . parent::__toString() . " ; [Spécialité]: " . $this->_specialite;
    }

}

?>