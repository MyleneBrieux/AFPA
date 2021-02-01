<?php

include_once('Personne.php');

class Manager extends Personne {

    private $service;

    public function __construct(int $newId, string $newNom, string $newPrenom, string $newMail, string $newTelephone, float $newSalaire, string $newService){
        parent::__construct($newId, $newNom, $newPrenom, $newMail, $newTelephone, $newSalaire);
        $this->service=$newService;
    }

    public function afficher():void{
        echo <<<AFFICHE
    Le salaire du manager {$this->nom} {$this->prenom} est : {$this->calculerSalaire()}€, son service : {$this->service}
    AFFICHE;
    }

    public function calculerSalaire():float{
        return $this->salaire*1.3;
    }

    public function getService():string{
        return $this->service;
    }

    public function setService(string $newService):self{
        $this->service=$newService;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; 
        [Mail]: " . parent::__toString() . " ; [Téléphone]: " . parent::__toString() . " ; [Salaire]: " . parent::__toString() . " ; 
        [Service]: " . $this->service;
    }

}

?>