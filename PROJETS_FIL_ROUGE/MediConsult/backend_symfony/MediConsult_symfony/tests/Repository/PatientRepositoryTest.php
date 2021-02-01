<?php

namespace App\Tests\Repository;

use App\Entity\Patient;
use App\DataFixtures\RemovePatientFixtures;
use App\DataFixtures\PatientFixtures;
use App\Repository\PatientRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PatientRepositoryTest extends KernelTestCase {

    use FixturesTrait;

    private $repository;
    private $passwordEncoder;

    protected function setUp():void{
        self::bootKernel();
        $this->repository = self::$container->get(PatientRepository::class);
        $this->passwordEncoder = self::$container->get(UserPasswordEncoderInterface::class);
    }

    // PERMET LA SUPPRESSION DES DONNEES //
    protected function tearDown():void{
        $this->loadFixtures([RemovePatientFixtures::class]);
    }

    // TU SUR LES METHODES DE PATIENTREPOSITORY //
    public function testFindPatient(){
        $this->loadFixtures([PatientFixtures::class]);
        $patient=$this->repository->find(1);
        $this->assertEquals(1,$patient->getId());
    }

    public function testFindOneBy(){
        $this->loadFixtures([PatientFixtures::class]);
        $patient=$this->repository->findOneBy(["id" => 1]);
        $this->assertEquals(1,$patient->getId());
    }

    public function testFindAll(){
        $this->loadFixtures([PatientFixtures::class]);
        $patients=$this->repository->findAll();
        $this->assertCount(1,$patients);
    }

    public function testFindBy(){
        $this->loadFixtures([PatientFixtures::class]);
        $patient = $this->repository->findBy(["prenom" => "Mylène"]);
        $this->assertCount(1, $patient);
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
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($patient);
        $manager->flush();                
        $this->assertCount(1, $this->repository->findAll());
    }

}

?>