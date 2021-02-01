<?php

namespace App\Tests\Repository;

use App\Entity\Specialiste;
use App\DataFixtures\SpecialisteFixtures;
use App\Repository\SpecialisteRepository;
use App\DataFixtures\RemoveSpecialisteFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SpecialisteRepositoryTest extends KernelTestCase {

    use FixturesTrait;

    private $repository;
    private $passwordEncoder;

    protected function setUp():void{
        self::bootKernel();
        $this->repository = self::$container->get(SpecialisteRepository::class);
        $this->passwordEncoder = self::$container->get(UserPasswordEncoderInterface::class);
    }

    // PERMET LA SUPPRESSION DES DONNEES //
    protected function tearDown():void{
        $this->loadFixtures([RemoveSpecialisteFixtures::class]);
    }

    // TU SUR LES METHODES DE PRATICIENREPOSITORY //
    public function testFindSpecialiste(){
        $this->loadFixtures([SpecialisteFixtures::class]);
        $specialiste=$this->repository->find(1);
        $this->assertEquals(1,$specialiste->getId());
    }

    public function testFindOneBy(){
        $this->loadFixtures([SpecialisteFixtures::class]);
        $specialiste=$this->repository->findOneBy(["id" => 1]);
        $this->assertEquals(1,$specialiste->getId());
    }

    public function testFindAll(){
        $this->loadFixtures([SpecialisteFixtures::class]);
        $specialistes=$this->repository->findAll();
        $this->assertCount(1,$specialistes);
    }

    public function testFindBy(){
        $this->loadFixtures([SpecialisteFixtures::class]);
        $specialiste = $this->repository->findBy(["prenom" => "Fanny 1"]);
        $this->assertCount(0, $specialiste);
    }

    // TU SUR LE MANAGER //
    public function testManagerPersist(){
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
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($specialiste);
        $manager->flush();                
        $this->assertCount(1, $this->repository->findAll());
    }

}

?>