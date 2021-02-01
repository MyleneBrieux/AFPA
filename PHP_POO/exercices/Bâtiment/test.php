<?php

include_once('Batiment.php');
include_once('Maison.php');

$batiment1 = new Batiment("40 rue Isaac Holden 59170 CROIX");

$maison1 = new Maison($batiment1->getAdresse(), 65.5, 4);

echo $batiment1->presentationBat() . "\n";
echo $maison1->presentationMaison() . "\n";
var_dump($maison1);

?>