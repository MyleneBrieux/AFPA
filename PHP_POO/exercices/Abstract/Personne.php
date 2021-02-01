<?php

abstract class Personne {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $mail;
    protected $telephone;
    protected $salaire;
    public static $counter=0;

    public function __construct(int $newId, string $newNom, string $newPrenom, string $newMail, string $newTelephone, float $newSalaire){
        $this->id=$newId;
        $this->nom=$newNom;
        $this->prenom=$newPrenom;
        $this->mail=$newMail;
        $this->telephone=$newTelephone;
        $this->salaire=$newSalaire;
        self::$counter++;
    }

    public abstract function calculerSalaire():float;

    public function affiche():void{
        echo $this;
    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $newId):self{
        $this->id=$newId;
        return $this;
    }

    public function getNom():string{
        return $this->nom;
    }

    public function setNom(string $newNom):self{
        $this->nom=$newNom;
        return $this;
    }

    public function getPrenom():string{
        return $this->prenom;
    }

    public function setPrenom(string $newPrenom):self{
        $this->prenom=$newPrenom;
        return $this;
    }

    public function getMail():string{
        return $this->mail;
    }

    public function setMail(string $newMail):self{
        $this->mail=$newMail;
        return $this;
    }

    public function getTelephone():string{
        return $this->telephone;
    }

    public function setTelephone(string $newTelephone):self{
        $this->telephone=$newTelephone;
        return $this;
    }

    public function getSalaire():float{
        return $this->salaire;
    }

    public function setSalaire(float $newSalaire):self{
        $this->salaire=$newSalaire;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . $this->id . " ; [Nom]: " . $this->nom . " ; [Prénom]: " . $this->prenom . " ; [Mail]: " . $this->mail . " ; [Téléphone]: " . $this->telephone . " ; [Salaire]: " . $this->salaire;
    }

}

?>