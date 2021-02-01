<?php

/* RECUPERATION DES METHODES */
include_once('Developpeur.php');
include_once('Manager.php');


/* CREATION DE DEUX DEVELOPPEURS */
$developpeur1 = new Developpeur (1,"SALIM","Martin","s.m@gmail.com","0610203040",833.2,"PHP");
$developpeur2 = new Developpeur (2,"Legrand","Rachel","r.l@gmail.com","0650607080",2500.9,"C++");


/* CREATION DE DEUX MANAGERS */
$manager1 = new Manager (3,"LACHGAR","Jean","j.l@gmail.com","0710203040",2307.7,"Informatique");
$manager2 = new Manager (4,"Chemin","Marie","m.c@gmail.com","0750607080",2000.3,"SAV");


/* AFFICHAGE */
echo "Nombre de personnes créées : " . Personne::$counter . "\n";
echo $developpeur1->afficher() . "\n";
$manager1->afficher();


/* CREATION D'UN OBJET DE TYPE PERSONNE */
/* Impossible car la classe Personne est abstraite, elle ne permet pas de créer d'objets */

?>