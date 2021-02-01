<?php

namespace App\Brouillon;

class Calculateur {

    public function addition(int $a, int $b) : int {
        $result = $a+$b;
        return $result;
    }

    public function division(int $c, int $d) : int {
        $result = $c/$d;
        return $result;
    }

}

?>