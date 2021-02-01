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

        $specialiste1=new Specialiste();
        $specialiste1->setNom("BALLOIS");
        $specialiste1->setPrenom("Fanny");
        $specialiste1->setSpecialite("Médecin généraliste");
        $specialiste1->setAdresse("4 avenue Jussieu 59170 CROIX");           
        $specialiste1->setEmail("fanny.ballois@gmail.com");
        $specialiste1->setRoles(["ROLE_USER"]);
        $specialiste1->setPassword($this->passwordEncoder->encodePassword(
                                                                    $specialiste1,
                                                                    'fannyballois'
                            ));                  
        $manager->persist($specialiste1);

        $specialiste2=new Specialiste();
        $specialiste2->setNom("LANDY");
        $specialiste2->setPrenom("Pauline");
        $specialiste2->setSpecialite("Infirmier");
        $specialiste2->setAdresse("11 rue Ghesquière 59170 CROIX");           
        $specialiste2->setEmail("pauline.landy@gmail.com");
        $specialiste2->setRoles(["ROLE_USER"]);
        $specialiste2->setPassword($this->passwordEncoder->encodePassword(
                                                                    $specialiste2,
                                                                    'paulinelandy'
                            ));                  
        $manager->persist($specialiste2);

        $specialiste3=new Specialiste();
        $specialiste3->setNom("SEMAILLE");
        $specialiste3->setPrenom("Eric");
        $specialiste3->setSpecialite("Médecin généraliste");
        $specialiste3->setAdresse("20 zac de la Brasserie Espagnole 59194 RÂCHES");           
        $specialiste3->setEmail("eric.semaille@gmail.com");
        $specialiste3->setRoles(["ROLE_USER"]);
        $specialiste3->setPassword($this->passwordEncoder->encodePassword(
                                                                    $specialiste3,
                                                                    'ericsemaille'
                            ));                  
        $manager->persist($specialiste3);

        $specialiste4=new Specialiste();
        $specialiste4->setNom("CARPENTIER");
        $specialiste4->setPrenom("Olivier");
        $specialiste4->setSpecialite("Dermatologue");
        $specialiste4->setAdresse("11 boulevard Lacordaire 59100 ROUBAIX");           
        $specialiste4->setEmail("olivier.carpentier@gmail.com");
        $specialiste4->setRoles(["ROLE_USER"]);
        $specialiste4->setPassword($this->passwordEncoder->encodePassword(
                                                                    $specialiste4,
                                                                    'oliviercarpentier'
                            ));                  
        $manager->persist($specialiste4);

        $manager->flush();
    }
}