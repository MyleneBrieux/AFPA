<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Patient;
use App\Entity\Specialiste;
use App\Entity\RendezVous;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RendezVousFixtures extends Fixture
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
        
        $manager->persist($rendezVous);
        
        $manager->flush();
    
    }
}
