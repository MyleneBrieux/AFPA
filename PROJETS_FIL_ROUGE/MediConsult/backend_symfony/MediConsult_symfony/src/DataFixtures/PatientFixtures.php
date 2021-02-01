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

        $patient1=new Patient();
        $patient1->setNom("BRIEUX");
        $patient1->setPrenom("Mylène");
        $patient1->setAge(28);
        $patient1->setEmail("mylene.brieux@gmail.com");
        $patient1->setRoles(["ROLE_USER"]);
        $patient1->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient1,
                                                                    'afpamy13'
                            ));
        $manager->persist($patient1);

        $patient2=new Patient();
        $patient2->setNom("OLIVIER");
        $patient2->setPrenom("Doniphan");
        $patient2->setAge(27);
        $patient2->setEmail("doniphan.olivier@gmail.com");
        $patient2->setRoles(["ROLE_USER"]);
        $patient2->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient2,
                                                                    '27051994'
                            ));
        $manager->persist($patient2);

        $patient3=new Patient();
        $patient3->setNom("BRIEUX");
        $patient3->setPrenom("Véronique");
        $patient3->setAge(56);
        $patient3->setEmail("v.brieux@gmail.com");
        $patient3->setRoles(["ROLE_USER"]);
        $patient3->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient3,
                                                                    '24051965'
                            ));
        $manager->persist($patient3);

        $patient4=new Patient();
        $patient4->setNom("BRIEUX");
        $patient4->setPrenom("Marc");
        $patient4->setAge(59);
        $patient4->setEmail("m.brieux@gmail.com");
        $patient4->setRoles(["ROLE_USER"]);
        $patient4->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient4,
                                                                    '05111962'
                            ));
        $manager->persist($patient4);

        $patient5=new Patient();
        $patient5->setNom("BRIEUX");
        $patient5->setPrenom("Yoann");
        $patient5->setAge(32);
        $patient5->setEmail("yoann.brieux@gmail.com");
        $patient5->setRoles(["ROLE_USER"]);
        $patient5->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient5,
                                                                    '27121988'
                            ));
        $manager->persist($patient5);
        
        $patient6=new Patient();
        $patient6->setNom("BRIEUX");
        $patient6->setPrenom("Aurélie");
        $patient6->setAge(31);
        $patient6->setEmail("aurelie.brieux@gmail.com");
        $patient6->setRoles(["ROLE_USER"]);
        $patient6->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient6,
                                                                    '27021990'
                            ));
        $manager->persist($patient6);

        $patient7=new Patient();
        $patient7->setNom("BRIEUX");
        $patient7->setPrenom("Rémi");
        $patient7->setAge(1);
        $patient7->setEmail("remi.brieux@gmail.com");
        $patient7->setRoles(["ROLE_USER"]);
        $patient7->setPassword($this->passwordEncoder->encodePassword(
                                                                    $patient7,
                                                                    '19072020'
                            ));
        $manager->persist($patient7);
        
        $manager->flush();

    }

}
