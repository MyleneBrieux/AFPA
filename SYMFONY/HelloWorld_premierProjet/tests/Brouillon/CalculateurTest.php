<?php

namespace App\Test\Brouillon;

use App\Brouillon\Calculateur;
use PHPUnit\Framework\TestCase;

class CalculateurTest extends TestCase {
    
    public function testAdditionNombresPositifs(){
        $calcul = new Calculateur();
        $result = $calcul->addition(5,10);
        $this->assertEquals(15,$result);
    }

    public function testDivisionNombresPositifs(){
        $calcul = new Calculateur();
        $result = $calcul->division(5,10);
        $this->assertEquals(0.5,$result);
    }

} 



?>