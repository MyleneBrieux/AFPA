<?php

include_once('Ouvrier.php');
include_once('Cadre.php');
include_once('Patron.php');

/* CREATION DES OUVRIERS */
$ouvrier1 = new Ouvrier();
$ouvrier1->setMatricule(1)->setNom("Dupont")->setPrenom("Michel")->setDateDeNaissance(new DateTime("01/01/1966"))->setDateEntree(new DateTime("01/01/2000"));


/* CREATION DES CADRES */
$cadre1 = new Cadre();
$cadre1->setMatricule(2)->setNom("Leroy")->setPrenom("Marie")->setDateDeNaissance(new DateTime("01/01/1966"))->setIndice(4);


/* CREATION DU PATRON */
$patron1 = new Patron();
$patron1->setMatricule(10)->setNom("Laneige")->setPrenom("Barbara")->setDateDeNaissance(new DateTime("01/01/1966"))->setPourcentage(20);


/* AFFICHAGE */
// echo $ouvrier1->getSalaire();
// echo $cadre1->getSalaire();
// echo $patron1->getSalaire();
;

/* ATTRIBUTS OPTIONNELS */
// function bonjour($name, ?string $prenom = "Monsieur/Madame") : void 
// {
//     echo "Bonjour $prenom $name";
// }
// ​
// bonjour("DUPOND");


?>