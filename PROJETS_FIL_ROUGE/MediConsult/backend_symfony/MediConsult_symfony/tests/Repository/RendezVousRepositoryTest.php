<?php

namespace App\Tests\Repository;

use DateTime;
use App\Entity\Patient;
use App\Entity\Specialiste;
use App\Entity\RendezVous;
use App\DataFixtures\RendezVousFixtures;
use App\Repository\RendezVousRepository;
use App\DataFixtures\RemoveRendezVousFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RendezVousRepositoryTest extends KernelTestCase {

    use FixturesTrait;

    private $repository;
    private $passwordEncoder;

    protected function setUp():void{
        self::bootKernel();
        $this->repository = self::$container->get(RendezVousRepository::class);
        $this->passwordEncoder = self::$container->get(UserPasswordEncoderInterface::class);
    }

    // PERMET LA SUPPRESSION DES DONNEES //
    protected function tearDown():void{
        $this->loadFixtures([RemoveRendezVousFixtures::class]);
    }

    // TU SUR LES METHODES DE RENDEZVOUSREPOSITORY //
    public function testFindRendezVous(){
        $this->loadFixtures([RendezVousFixtures::class]);
        $rendezVous=$this->repository->find(1);
        $this->assertEquals(1,$rendezVous->getId());
    }

    public function testFindOneBy(){
        $this->loadFixtures([RendezVousFixtures::class]);
        $rendezVous=$this->repository->findOneBy(["id" => 1]);
        $this->assertEquals(1,$rendezVous->getId());
    }

    public function testFindAll(){
        $this->loadFixtures([RendezVousFixtures::class]);
        $patients=$this->repository->findAll();
        $this->assertCount(1,$patients);
    }

    public function testFindBy(){
        $date = new DateTime("2020-12-16");
        $this->loadFixtures([RendezVousFixtures::class]);
        $rendezVous = $this->repository->findBy(["date" => $date]);
        $this->assertCount(0, $rendezVous);
    }

    // TU SUR LE MANAGER //
    public function testManagerPersist(){
        $patient=new Patient();
        $patient->setNom("BRIEUX");
        $patient->setPrenom("Mylène");
        $patient->setAge(28);
        $patient->setEmail("mylene.brieux@gmail.com");
        $patient->setRoles(["ROLE_USER"]);
        $patient->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient,
                                                                    'afpamy13'
                            ));

        $specialiste = new Specialiste();
        $specialiste->setNom("BALLOIS");
        $specialiste->setPrenom("Fanny");
        $specialiste->setSpecialite("Médecin généraliste");
        $specialiste->setAdresse("4 avenue Jussieu 59170 CROIX");           
        $specialiste->setEmail("fanny.ballois@gmail.com");
        $specialiste->setRoles(["ROLE_USER"]);
        $specialiste->setPassword($this->passwordEncoder->encodePassword(
                                                                        $specialiste,
                                                                        'fannyballois'
                                ));   

        $date = new DateTime("2021-01-05");

        $horaire = new DateTime("18:20");

        $rendezVous = (new RendezVous())->setDate($date)->setHoraire($horaire)->setPatient($patient)->setSpecialiste($specialiste);
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($rendezVous);
        $manager->flush();                
        $this->assertCount(1, $this->repository->findAll());
    }

}

?>