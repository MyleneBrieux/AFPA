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
        $date1 = new DateTime("2021-02-02");
        $horaire1 = new DateTime("16:45");
        $rendezVous1 = (new RendezVous())->setDate($date1)->setHoraire($horaire1)->setPatient($patient1)->setSpecialiste($specialiste1);
        $manager->persist($rendezVous1);



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
        $date2 = new DateTime("2021-01-14");
        $horaire2 = new DateTime("14:30");
        $rendezVous2 = (new RendezVous())->setDate($date2)->setHoraire($horaire2)->setPatient($patient2)->setSpecialiste($specialiste1);
        $manager->persist($rendezVous2);



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
        $date3 = new DateTime("2021-02-01");
        $horaire3 = new DateTime("18:30");
        $rendezVous3 = (new RendezVous())->setDate($date3)->setHoraire($horaire3)->setPatient($patient3)->setSpecialiste($specialiste3);
        $manager->persist($rendezVous3);
        
        

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
        $date4 = new DateTime("2021-02-01");
        $horaire4 = new DateTime("18:45");
        $rendezVous4 = (new RendezVous())->setDate($date4)->setHoraire($horaire4)->setPatient($patient4)->setSpecialiste($specialiste3);
        $manager->persist($rendezVous4);



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
        $date5 = new DateTime("2021-02-10");
        $horaire5 = new DateTime("19:00");
        $rendezVous5 = (new RendezVous())->setDate($date5)->setHoraire($horaire5)->setPatient($patient5)->setSpecialiste($specialiste3);
        $manager->persist($rendezVous5);



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
        $date6 = new DateTime("2021-02-10");
        $horaire6 = new DateTime("18:45");
        $rendezVous6 = (new RendezVous())->setDate($date6)->setHoraire($horaire6)->setPatient($patient6)->setSpecialiste($specialiste3);
        $manager->persist($rendezVous6);



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
        $date7 = new DateTime("2021-01-15");
        $horaire7 = new DateTime("18:45");
        $rendezVous7 = (new RendezVous())->setDate($date7)->setHoraire($horaire7)->setPatient($patient1)->setSpecialiste($specialiste2);
        $manager->persist($rendezVous7);



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
        $date8 = new DateTime("2021-03-01");
        $horaire8 = new DateTime("18:20");
        $rendezVous8 = (new RendezVous())->setDate($date8)->setHoraire($horaire8)->setPatient($patient1)->setSpecialiste($specialiste4);
        $manager->persist($rendezVous8);          

        

        $manager->flush();
    
    }
}
