<?php

Class profil {

    private $id;
    private $code;
    private $libelle;

    public function __construct(int $newId, string $newCode, string $newLibelle) {
        $this->id=$newId;
        $this->code=$newCode;
        $this->libelle=$newLibelle;
    }

    public function getId():int{
        return $this->id;
    }

    // public function setId(int $newId):self{ ||| INUTILE CAR AUTOINCREMENTATION
    //     $this->id=$newId;
    //     return $this;
    // }

    public function getCode():string{
        return $this->code;
    }

    public function setCode(string $newCode):self{
        $this->code=$newCode;
        return $this;
    }

    public function getLibelle():string{
        return $this->libelle;
    }

    public function setLibelle(string $newLibelle):self{
        $this->libelle=$newLibelle;
        return $this;
    }

    public function __toString():string{
        return "[ID]: " . $this->id . " ; [Code]: " . $this->code . " ; [Libellé]: " . $this->libelle;
    }

}

?>