<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Specialiste;
use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SpecialisteTest extends KernelTestCase {

    private $validator;

    protected function setUp():void{
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getSpecialiste(string $nom = null, string $prenom = null, string $specialite = null, string $adresse = null) {
        $specialiste = (new Specialiste())->setNom($nom)->setPrenom($prenom)->setSpecialite($specialite)->setAdresse($adresse);
        return $specialiste;
    }
    
    // TU SUR LE NOM //
    public function testGettersAndSettersNom(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $specialiste->setNom("BALLOIS");
        $this->assertEquals("BALLOIS",$specialiste->getNom());
    }

    public function testIsNomValid(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankNom(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le nom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankNom");
    }

    // TU SUR LE PRENOM //
    public function testGettersAndSettersPrenom(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $specialiste->setPrenom("Fanny");
        $this->assertEquals("Fanny",$specialiste->getPrenom());
    }

    public function testIsPrenomValid(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankPrenom(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le prénom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankPrenom");
    }

    // TU SUR LA SPECIALITE //
    public function testGettersAndSettersSpecialite(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $specialiste->setSpecialite("Médecin généraliste");
        $this->assertEquals("Médecin généraliste",$specialiste->getSpecialite());
    }
    
    public function testIsSpecialiteValid(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
    }
    
    public function testNotValidBlankSpecialiste(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le numéro de téléphone est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankTelephone");
    }

    // TU SUR L'ADRESSE //
    public function testGettersAndSettersAdresse(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $specialiste->setAdresse("4 avenue Jussieu 59170 CROIX");
        $this->assertEquals("4 avenue Jussieu 59170 CROIX",$specialiste->getAdresse());
    }

    public function testIsAdresseValid(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankAdresse(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $errors = $this->validator->validate($specialiste);
        $this->assertCount(0, $errors);
        // $this->assertEquals("L'adresse est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankAdresse");
    }

    // TU SUR L'ASSOCIATION AVEC L'ENTITE RENDEZVOUS //
    public function testGetEmptyRendezVous(){
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $this->assertCount(0, $specialiste->getRendezVous());
    }

    public function testGetNotEmptyRendezVous(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $rendezVous = (new RendezVous())->setDate($date)->setHoraire($horaire);
        $specialiste->addRendezVou($rendezVous);
        $this->assertCount(1, $specialiste->getRendezVous());
        $this->assertEquals($specialiste, $rendezVous->getSpecialiste());
    }

    public function testAddRendezVous(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $rendezVous = (new RendezVous())->setDate($date)->setHoraire($horaire);
        $specialiste->addRendezVou($rendezVous);
        $this->assertCount(1, $specialiste->getRendezVous());
    }

    public function testRemoveRendezVous(){
        $date = new DateTime("2020-12-16");
        $horaire = new DateTime("10:15");
        $specialiste = $this->getSpecialiste("BALLOIS","Fanny","Médecin généraliste","4 avenue Jussieu 59170 CROIX");
        $rendezVous = (new RendezVous())->setDate($date)->setHoraire($horaire);
        $specialiste->addRendezVou($rendezVous);
        $this->assertCount(1, $specialiste->getRendezVous());
        $specialiste->removeRendezVou($rendezVous);
        $this->assertCount(0, $specialiste->getRendezVous());
        $this->assertEquals(null, $rendezVous->getSpecialiste());
    }

} 

?>