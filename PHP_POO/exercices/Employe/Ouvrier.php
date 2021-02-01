<?php

include_once('Employe.php');
include_once('DateUtility.php');

class Ouvrier extends Employe {
    
    private $dateEntree;
    private static $smic=2500;
    // const SAL_MAX=5000;


    public function getSalaire():?float{
        $anciennete = DateUtility::getDifferenceInYears(new DateTime(),$this->dateEntree);
        $salaire = Ouvrier::$smic + $anciennete*100;
            if ($salaire>Ouvrier::$smic*2){ /* OU SAL_MAX */
                return Ouvrier::$smic*2; /* RETURN SAL_MAX */
            } else {
                return $salaire;
            }
    }


    public function getDateEntree():DateTime{
        return $this->dateEntree;
    }

    public function setDateEntree(DateTime $dateEntree):self{
        $this->dateEntree=$dateEntree;
        return $this;
    }

}

?>