<?php

include_once('Employe.php');

class Cadre extends Employe {
    
    private $indice;


    public function getSalaire():?float{
        switch ($this->indice){
            case 1 : {
                return 13000;
            }
            case 2 : {
                return 15000;
            }
            case 3 : {
                return 17000;
            }
            case 4 : {
                return 20000;
            }
            default : {
                return null;
            }
        }
    }


    public function getIndice():int{
        return $this->indice;
    }

    public function setIndice(int $indice):self{
        if($indice<0 || $indice>4){
            $this->indice=null;
        }
        else {
            $this->indice=$indice;
        }
        return $this;
    }

}

?>