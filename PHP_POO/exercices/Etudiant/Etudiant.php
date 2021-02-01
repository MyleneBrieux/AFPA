<?php

include_once('Personne.php');

class Etudiant extends Personne {

    private $cne;
    
    public function __construct(int $newId, string $newNom, string $newPrenom, string $newCne){
        parent::__construct($newId, $newNom, $newPrenom);
        $this->cne=$newCne;
    }

    public function presentationEtudiant():string {
        return "Je suis " . $this->getNom() . " " . $this->getPrenom() . " mon CNE est : " . $this->cne ;
    }

    public function getCne():string{
        return $this->cne;
    }

    public function setCne(string $newCne):self{
        $this->cne=$newCne;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . parent::__toString() . " ; [Nom]: " . parent::__toString() . " ; [Prénom]: " . parent::__toString() . " ; [CNE]: " . $this->cne;
    }

}
?>