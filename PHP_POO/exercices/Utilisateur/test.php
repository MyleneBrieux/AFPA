<?php

include_once('Personne.php');
include_once('Utilisateur.php');
include_once('Profil.php');


/* CREATION DE DIFFERENTS PROFILS */
$profilMN = new Profil (1, "MN", "Manager");
$profilDG = new Profil (2, "DG", "Directeur général");
$profilCP = new Profil (3, "CP", "Chef de projet");


/* CREATION DE PERSONNES */
/* Impossible car la classe Personne est abstraite, elle ne peut donc pas instancier d'objet */


/* CREATION D'UTILISATEURS */
$user1 = new Utilisateur (1,"Dupont","David","d.d@d.com","0610101010",1000, "Dave","123456","Ressources Humaines",$profilMN);
$user2 = new Utilisateur (2,"Chemin","Paul","p.c@d.com","0620202020",10000, "Polo","789101","Direction",$profilDG);
$user3 = new Utilisateur (3,"Sy","Omar","o.s@d.com","0630303030",100000, "Omar","111213","Informatique",$profilCP);


/* AFFICHAGE */
// var_dump($user1);
echo $user1->calculerSalaire() . "\n" . $user2->calculerSalaire() . "\n" . $user3->calculerSalaire();

?>