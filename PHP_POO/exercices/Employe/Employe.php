<?php

abstract class Employe {
    
    protected $matricule;
    protected $nom;
    protected $prenom;
    protected $dateDeNaissance;


    public abstract function getSalaire():?float;

    
    public function getMatricule():int{
        return $this->matricule;
    }

    public function setMatricule(int $matricule):self{
        $this->matricule=$matricule;
        return $this;
    }

    public function getNom():string{
        return $this->nom;
    }

    public function setNom(string $nom):self{
        $this->nom=$nom;
        return $this;
    }

    public function getPrenom():string{
        return $this->prenom;
    }

    public function setPrenom(string $prenom):self{
        $this->prenom=$prenom;
        return $this;
    }

    public function getDateDeNaissance():DateTime{
        return $this->datenaissance;
    }

    public function setDateDeNaissance(DateTime $datenaissance):self{
        $this->datenaissance=$datenaissance;
        return $this;
    }

}

?>