<?php

include_once('Personne.php');
include_once('Etudiant.php');
include_once('Employe.php');
include_once('Professeur.php');

/* CREATION DES EMPLOYES */
$personne1 = new Personne (1, "DOUK", "Rachid");
$employe1 = new Employe($personne1->getId(), $personne1->getNom(), $personne1->getPrenom(), 10000.0);

$personne2 = new Personne (2, "NGOYE", "Roland");
$employe2 = new Employe($personne2->getId(), $personne2->getNom(), $personne2->getPrenom(), 10000.0);

/* CREATION DES ETUDIANTS */
$personne3 = new Personne (3, "OBAKA", "Med");
$etudiant1 = new Etudiant($personne3->getId(), $personne3->getNom(), $personne3->getPrenom(), 65678754);

$personne4 = new Personne (4, "ALSENY", "Thomas");
$etudiant2 = new Etudiant($personne4->getId(), $personne4->getNom(), $personne4->getPrenom(), 87543543);

/* CREATION DES PROFESSEURS */
$personne5 = new Personne (5, "OBA", "Kevin");
$employe3 = new Employe ($personne5->getId(), $personne5->getNom(), $personne5->getPrenom(), 5700.0);
$professeur1 = new Professeur($personne5->getId(), $personne5->getNom(), $personne5->getPrenom(), $employe3->getSalaire(), "JAVA/JEE");

$personne6 = new Personne (6, "MAGASSOUBA", "Cheick");
$employe4 = new Employe ($personne6->getId(), $personne6->getNom(), $personne6->getPrenom(), 5000.0);
$professeur2 = new Professeur($personne6->getId(), $personne6->getNom(), $personne6->getPrenom(), $employe4->getSalaire(), "PHP");

/* AFFICHAGE */
echo "La liste des employés : \n";
echo $employe1->presentationEmploye() . "\n";
// var_dump($employe1);
echo $employe2->presentationEmploye() . "\n";
// var_dump($employe2);
echo "La liste des étudiants : \n";
echo $etudiant1->presentationEtudiant() . "\n";
// var_dump($etudiant1);
echo $etudiant2->presentationEtudiant() . "\n";
// var_dump($etudiant2);
echo "La liste des professeurs : \n";
echo $professeur1->presentationProfesseur() . "\n";
// var_dump($professeur1);
echo $professeur2->presentationProfesseur() . "\n";
// var_dump($professeur2);
?>