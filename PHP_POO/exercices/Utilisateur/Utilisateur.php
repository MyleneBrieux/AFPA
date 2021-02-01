<?php

include_once('Personne.php');
include_once('Profil.php');

Class Utilisateur extends Personne {

    private $login;
    private $password;
    private $service;
    private $profil;

    public function __construct(int $newId, string $newNom, string $newPrenom, string $newMail, string $newTelephone, float $newSalaire, 
                                string $newLogin, string $newPassword, string $newService, Profil $newProfil) {
        parent::__construct($newId, $newNom, $newPrenom, $newMail, $newTelephone, $newSalaire);
        $this->login=$newLogin;
        $this->password=$newPassword;
        $this->service=$newService;
        $this->profil=$newProfil;
    }

    public function affiche():void {
        echo $this;
    }

    public function calculerSalaire():float {
        if($this->profil->getCode() == "MN"){
            return $this->salaire*1.1;
        } elseif($this->profil->getCode() == "DG") {
            return $this->salaire*1.4;
        }
    return $this->salaire;
    }

    public function getLogin():string{
        return $this->login;
    }

    public function setLogin(string $newLogin):self{
        $this->login=$newLogin;
        return $this;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function setPassword(string $newPassword):self{
        $this->password=$newPassword;
        return $this;
    }

    public function getService():string{
        return $this->service;
    }

    public function setService(string $newService):self{
        $this->service=$newService;
        return $this;
    }

    public function getProfil():Profil{
        return $this->profil;
    }

    public function setProfil(Profil $newProfil):self{
        $this->profil=$newProfil;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; [Mail]: " . parent::__toString() . 
        " ; [Téléphone]: " . parent::__toString() . " ; [Salaire]: " . parent::__toString() . " ; [Login]: " . $this->login . " ; [Password]: " . $this->password . 
        " ; [Service]: " . $this->service;
    }

}

?>