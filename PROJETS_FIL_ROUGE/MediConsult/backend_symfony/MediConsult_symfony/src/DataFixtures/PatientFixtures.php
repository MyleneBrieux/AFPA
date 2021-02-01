<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PatientFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

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
        $manager->persist($patient);
        
        $manager->flush();

    }

}
