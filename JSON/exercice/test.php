<?php

include_once("Voiture.php");


$voitures = [new Voiture("RENAULT","CLIO"),
             new Voiture("RENAULT","TWINGO"),
             new Voiture("RENAULT","ZOE"),
             new Voiture("OPEL","ASTRA"),
             new Voiture("OPEL","CORSA"),
             new Voiture("OPEL","GRANDLAND"),
             new Voiture("FIAT","500"),
             new Voiture("FIAT","TIPO"),
             new Voiture("FIAT","PANDA")];

             
if(!empty($_GET) && isset($_GET["marque"]) && isset($_GET["modele"])){ 
    $voituresRetournees = filterVoitureSelonMarqueEtModele($voitures,$_GET["marque"], $_GET["modele"]);
} elseif(empty($_GET)) { 
    $voituresRetournees = $voitures;
} elseif(isset($_GET["marque"])){
    $voituresRetournees = filterVoitureSelonMarqueEtModele($voitures,$_GET["marque"]);
}
echo json_encode($voituresRetournees);


function filterVoitureSelonMarqueEtModele(array $voitures, string $marque, string $modele=null) : array {
    $voituresRetournees=[];
    foreach ($voitures as $voiture) { 
        if($modele && $marque && $marque == $voiture->marque && $modele == $voiture->modele){
            $voituresRetournees[] = $voiture;
        } elseif(!$modele && $marque && $marque == $voiture->marque){ 
            $voituresRetournees[]=$voiture; 
        } 
    }
    return $voituresRetournees;
}


?>