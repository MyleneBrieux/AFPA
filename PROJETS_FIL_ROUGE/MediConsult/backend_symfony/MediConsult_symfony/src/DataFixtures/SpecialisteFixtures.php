<?php

namespace App\DataFixtures;

use App\Entity\Specialiste;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SpecialisteFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

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
        $manager->persist($specialiste);

        $manager->flush();
    }
}