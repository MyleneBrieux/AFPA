<?php

include_once('Employe.php');

class Patron extends Employe {
    
    private static $ca = 100000;
    private $pourcentage;


    public function getSalaire():?float{
        return self::$ca*$this->pourcentage/100;
    }


    public function getPourcentage():int{
        return $this->pourcentage;
    }

    public function setPourcentage(int $pourcentage):self{
        $this->pourcentage=$pourcentage;
        return $this;
    }

}

?>