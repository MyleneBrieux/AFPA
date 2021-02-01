<?php

/* INCLURE LA PAGE AVEC LES METHODES */
include_once('service.php');
include_once('employe.php');

/* CREATION DE SERVICES */
$service1 = new Service();
$service1->setNoserv(1)->setService("SAV")->setVille("Douai");

$service2 = new Service();
$service2->setNoserv(2)->setService("Communication")->setVille("Loos");

/* CREATION DES EMPLOYES */
$employe1 = new Employe();
$employe1->setNoemp(1800)->setNom("Olivier")->setPrenom("Doniphan")->setEmploi("Programmeur")->setSup(1000)->setEmbauche(2017-01-01)->setSal(1600)->setComm(0)->setNoserv($service1->getNoserv());

$employe2 = new Employe();
$employe2->setNoemp(1801)->setNom("Olivier")->setPrenom("Carotte")->setEmploi("Chat")->setSup(0)->setEmbauche(2020-03-23)->setSal(0)->setComm(0)->setNoserv($service1->getNoserv());

$employe3 = new Employe();
$employe3->setNoemp(1802)->setNom("Moyen")->setPrenom("Toto")->setEmploi("Scrum Master")->setSup(1000)->setEmbauche(2020-10-27)->setSal(1500)->setComm(0)->setNoserv($service2->getNoserv());

$employe4 = new Employe();
$employe4->setNoemp(1803)->setNom("Dupont")->setPrenom("Marc")->setEmploi("Chargé de communication")->setSup(1000)->setEmbauche(2020-10-27)->setSal(1400)->setComm(0)->setNoserv($service2->getNoserv());

/* COMPARAISON */
    // if ($service1->getNoserv() == $service2->getNoserv()) {
    //     echo "Il s'agit du même service \n";
    // } else {
    //     echo "Il s'agit de deux services différents \n";
    // }

/* AFFICHE LE NUMERO DE SERVICE */
// echo $service1->getNoserv() . "\n";
// echo $employe1->getNoemp() . "\n";

/* AFFICHE LE RESULTAT DE LA METHODE CITEE */
// echo $service1->detailsServ() . "\n";
// echo $employe1->presentationEmp() . "\n";

/* AFFICHE LE RESULTAT DE LA METHODE __TOSTRING */
echo $service1 . "\n" . $service2 . "\n";
echo $employe1 . "\n" . $employe2 . "\n" . $employe3 . "\n" . $employe4;

?>