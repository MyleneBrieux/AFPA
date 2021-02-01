<?php

include_once("Objet.php");

class Service extends Objet {

    private $noserv;
    private $nomService;
    private $ville;

    public function __construct(int $noserv, ?string $nomService, ?string $ville){
        $this->noserv=$noserv;
        $this->nomService=$nomService;
        $this->ville=$ville;
    }

    // public function detailsServ():string {
    //     return "Le service portant le numéro " . $this->noserv . " appelé " . $this->service . " se trouve à " . $this->ville;
    // }

    public function getNoserv():int{
        return $this->noserv;
    }

    public function setNoserv(int $noserv):self{
        $this->noserv=$noserv;
        return $this;
    }

    public function getNomService():?string{
        return $this->nomService;
    }

    public function setNomService(?string $nomService):self{
        $this->nomService=$nomService;
        return $this;
    }

    public function getVille():?string{
        return $this->ville;
    }

    public function setVille(?string $ville):self{
        $this->ville=$ville;
        return $this;
    }

    public function __toString():string{
        return "[Numéro de service]: " . $this->noserv . " ; [Service]: " . $this->nomService . " ; [Ville]: " . $this->ville; 
    }

}

?>