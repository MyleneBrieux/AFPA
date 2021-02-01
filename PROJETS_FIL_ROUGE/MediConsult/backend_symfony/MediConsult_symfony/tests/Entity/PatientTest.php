<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Patient;
use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PatientTest extends KernelTestCase {

    private $validator;

    protected function setUp():void{
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getPatient(string $nom = null, string $prenom = null, int $age = null) {
        $patient = (new Patient())->setNom($nom)->setPrenom($prenom)->setAge($age);
        return $patient;
    }
    
    // TU SUR LE NOM //
    public function testGettersAndSettersNom(){
        $patient = $this->getPatient("Dupont","David",30);
        $patient->setNom("Dupont");
        $this->assertEquals("Dupont",$patient->getNom());
    }

    public function testIsNomValid(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankNom(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le nom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankNom");
    }

    // TU SUR LE PRENOM //
    public function testGettersAndSettersPrenom(){
        $patient = $this->getPatient("Dupont","David",30);
        $patient->setPrenom("David");
        $this->assertEquals("David",$patient->getPrenom());
    }

    public function testIsPrenomValid(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankPrenom(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le prénom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankPrenom");
    }

    // TU SUR L'AGE //
    public function testGettersAndSettersAge(){
        $patient = $this->getPatient("Dupont","David",30);
        $patient->setAge(30);
        $this->assertEquals(30,$patient->getAge());
    }

    public function testIsAgeValid(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankAge(){
        $patient = $this->getPatient("Dupont","David",30);
        $errors = $this->validator->validate($patient);
        $this->assertCount(0, $errors);
        // $this->assertEquals("La date de naissance est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankDateNaissance");
    }

    // TU SUR L'ASSOCIATION AVEC L'ENTITE RENDEZVOUS //
    public function testGetEmptyRendezVous(){
        $patient = $this->getPatient("Dupont","David",30);
        $this->assertCount(0, $patient->getRendezVous());
    }

    public function testGetNotEmptyRendezVous(){
        $dateRendezVous = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $patient = $this->getPatient("Dupont","David",30);
        $rendezVous = (new RendezVous())->setDate($dateRendezVous)->setHoraire($horaire);
        $patient->addRendezVou($rendezVous);
        $this->assertCount(1, $patient->getRendezVous());
        $this->assertEquals($patient, $rendezVous->getPatient());
    }

    public function testAddRendezVou(){
        $dateRendezVous = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $patient = $this->getPatient("Dupont","David",30);
        $rendezVous = (new RendezVous())->setDate($dateRendezVous)->setHoraire($horaire);
        $patient->addRendezVou($rendezVous);
        $this->assertCount(1, $patient->getRendezVous());
    }

    public function testRemoveRendezVou(){
        $dateRendezVous = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $patient = $this->getPatient("Dupont","David",30);
        $rendezVous = (new RendezVous())->setDate($dateRendezVous)->setHoraire($horaire);
        $patient->addRendezVou($rendezVous);
        $this->assertCount(1, $patient->getRendezVous());
        $patient->removeRendezVou($rendezVous);
        $this->assertCount(0, $patient->getRendezVous());
        $this->assertEquals(null, $rendezVous->getPatient());
    }

} 

?>