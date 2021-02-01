<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/detailempPRESENTATION.php");
include_once("../service/EmployeSERVICE.php");

// SI UTILISATEUR NON CONNECTE, RETOUR AU FORMULAIRE //
try { 
    session_start();
    if (!isset($_SESSION["mail"])){
        header('Location: ../User/formConnexion.php');
    }

// FONCTIONS GLOBALES //
displayDetails1();

$var1 = htmlentities($_GET["noemp"]);
$noemp=$var1;
$serviceemploye = new EmployeService();

try {
    $data=$serviceemploye->search($noemp);  
} catch (ServiceException $we) {
    afficherErreurSynthaxe($we->getCode(), $we->getMessage());
} 

displayPublicDetails($data);

    if(isset($_SESSION['mail']) && $_SESSION['profil'] == "admin"){
        displaySalComm($data);
    }

displayDetails2();

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>