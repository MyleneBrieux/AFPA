<?php

include_once("Objet.php");

class Employe extends Objet {

    private $noemp;
    private $nom;
    private $prenom;
    private $emploi;
    private $sup;
    private $embauche;
    private $sal;
    private $comm;
    private $noserv;

    public function __construct(int $noemp, ?string $nom, ?string $prenom, ?string $emploi, ?int $sup, ?string $embauche, ?float $sal, ?float $comm, int $noserv){
        $this->noemp=$noemp;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->emploi=$emploi;
        $this->sup=$sup;
        $this->embauche=$embauche;
        $this->sal=$sal;
        $this->comm=$comm;
        $this->noserv=$noserv;
    }

    public function description() {
        echo
        "L'employé portant le numéro " . $this->noemp . " s'appelle " . $this->nom . " " . $this->prenom . ". Il travaille comme " . $this->emploi .
        " et a pour supérieur l'employé portant le numéro " . $this->sup . ". Il a été embauché en " . $this->embauche . ", et gagne " . $this->sal . "€ ainsi que " . $this->comm .
        "€ de commissions. On peut le trouver au service n°" . $this->noserv ;
    }

    public function getNoemp():int{
        return $this->noemp;
    }

    public function setNoemp(int $noemp):self{
        $this->noemp=$noemp;
        return $this;
    }

    public function getNom():?string{
        return $this->nom;
    }

    public function setNom(?string $nom):self{
        $this->nom=$nom;
        return $this;
    }

    public function getPrenom():?string{
        return $this->prenom;
    }

    public function setPrenom(?string $prenom):self{
        $this->prenom=$prenom;
        return $this;
    }

    public function getEmploi():?string{
        return $this->emploi;
    }

    public function setEmploi(?string $emploi):self{
        $this->emploi=$emploi;
        return $this;
    }

    public function getSup():?int{
        return $this->sup;
    }

    public function setSup(?int $sup):self{
        $this->sup=$sup;
        return $this;
    }

    public function getEmbauche():?string{
        return $this->embauche;
    }

    public function setEmbauche(?string $embauche):self{
        $this->embauche=$embauche;
        return $this;
    }

    public function getSal():?float{
        return $this->sal;
    }

    public function setSal(?float $sal):self{
        $this->sal=$sal;
        return $this;
    }

    public function getComm():?float{
        return $this->comm;
    }

    public function setComm(?float $comm):self{
        $this->comm=$comm;
        return $this;
    }

    public function getNoserv():int{
        return $this->noserv;
    }

    public function setNoserv(int $noserv):self{
        $this->noserv=$noserv;
        return $this;
    }

    public function __toString():string{
        return " [Numéro employé] : " . $this->noemp . " [Nom] : " . $this->nom . " [Prénom] : " . $this->prenom . " [Emploi] : " . $this->emploi .
        " [Sup] : " . $this->sup . " [Embauche] : " . $this->embauche . " [Salaire] : " . $this->sal . " [Commission] : " . $this->comm .
        " [Numéro de service] : " . $this->noserv ;
    }
}

?>