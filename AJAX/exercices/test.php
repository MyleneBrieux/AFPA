<?php

include_once("Voiture.php");

// Toutes les voitures créées et insérées dans un tableau
$voitures = [new Voiture("RENAULT","CLIO"),
             new Voiture("RENAULT","TWINGO"),
             new Voiture("RENAULT","ZOE"),
             new Voiture("OPEL","ASTRA"),
             new Voiture("OPEL","CORSA"),
             new Voiture("OPEL","GRANDLAND"),
             new Voiture("FIAT","500"),
             new Voiture("FIAT","TIPO"),
             new Voiture("FIAT","PANDA")];


if(!empty($_GET) && isset($_GET["marque"]) && !isset($_GET["afficher"])){ // pour le deuxième select //
    $voituresRetournees = filterVoitureSelonMarqueEtModele($voitures,$_GET["marque"]);
    afficherOptions($voituresRetournees);
} 
elseif(empty($_GET)) { // pour le tableau //
    $voituresRetournees = $voitures;
} elseif(isset($_GET["marque"]) && isset($_GET["modele"])){ 
    $voituresRetournees = filterVoitureSelonMarqueEtModele($voitures,$_GET["marque"], $_GET["modele"]);
} elseif(isset($_GET["marque"])){
    $voituresRetournees = filterVoitureSelonMarqueEtModele($voitures,$_GET["marque"]);
}
foreach ($voituresRetournees as $voiture) { 
    echo 
        "<tr><td>" . $voiture->marque . "</td><td>" . $voiture->modele . "</td></tr>";
} 


// functions
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

function afficherOptions(array $voituresRetournees){
    echo
        "<option value=''>-- Sélectionnez un modèle --</option>"; 
    foreach ($voituresRetournees as $voiture) { 
        echo
            "<option value='" . $voiture->modele . "'>" . $voiture->modele . "</option>"; 
    }
}

?>