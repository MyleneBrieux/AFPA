<?php

class User {

    private $id;
    private $mail;
    private $password;
    private $profil;

    public function __construct(int $id, string $mail, string $password, string $profil){
        $this->id=$id;
        $this->mail=$mail;
        $this->password=$password;
        $this->profil=$profil;
    }

    public function presentationUser():string {
        return "L'utilisateur portant le numéro " . $this->id . ", a pour adresse email " . $this->mail . " et a le profil " . $this->utilisateur;
    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $id):self{
        $this->id=$id;
        return $this;
    }

    public function getMail():string{
        return $this->mail;
    }

    public function setMail(string $mail):self{
        $this->mail=$mail;
        return $this;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function setPassword(string $password):self{
        $this->password=$password;
        return $this;
    }

    public function getProfil():string{
        return $this->profil;
    }

    public function setProfil(string $profil):self{
        $this->profil=$profil;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . $this->id . " ; [Mail]: " . $this->mail . " ; [Profil]: " . $this->profil; 
    }

}

?>