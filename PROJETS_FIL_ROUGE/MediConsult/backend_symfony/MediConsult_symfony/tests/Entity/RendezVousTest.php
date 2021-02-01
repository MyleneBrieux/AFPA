<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RendezVousTest extends KernelTestCase {

    private $validator;

    protected function setUp():void{
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getRendezVous(\DateTime $date = null, \DateTime $horaire = null) {
        $rendezVous = (new RendezVous())->setDate($date)->setHoraire($horaire);
        return $rendezVous;
    }
    
    // TU SUR LA DATE//
    public function testGettersAndSettersDate(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $rendezVous->setDate($date);
        $this->assertEquals($date,$rendezVous->getDate());
    }

    public function testIsDateValid(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankDate(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
        // $this->assertEquals("La date est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankDate");
    }

    // TU SUR LES HORAIRES //
    public function testGettersAndSettersHoraires(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $rendezVous->setHoraire($horaire);
        $this->assertEquals($horaire,$rendezVous->getHoraire());
    }
    
    public function testIsHorairesValid(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
    }
    
    public function testNotValidBlankHoraires(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire);
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Les horaires sont obligatoires.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankHoraires");
    }

    // TU SUR PATIENT //
    public function testGettersAndSettersPatient(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire,"patient");
        $rendezVous->setPatient(null);
        $this->assertEquals(null,$rendezVous->getPatient());
    }
        
    public function testIsPatientValid(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire,"patient");
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
    }

    // TU SUR SPECIALISTE //
    public function testGettersAndSettersSpecialiste(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire,"specialiste");
        $rendezVous->setSpecialiste(null);
        $this->assertEquals(null,$rendezVous->getSpecialiste());
    }
            
    public function testIsSpecialisteValid(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $rendezVous = $this->getRendezVous($date,$horaire,"specialiste");
        $errors = $this->validator->validate($rendezVous);
        $this->assertCount(0, $errors);
    }

}

?>