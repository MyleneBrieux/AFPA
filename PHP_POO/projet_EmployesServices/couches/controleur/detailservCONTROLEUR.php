<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/detailservPRESENTATION.php");
include_once("../service/ServiceSERVICE.php");

// SI UTILISATEUR NON CONNECTE, RETOUR AU FORMULAIRE //
try { 
    session_start();
    if (!isset($_SESSION["mail"])){
        header('Location: ../User/formConnexion.php');
    }

// FONCTIONS GLOBALES //
displayDetails1();

$var1 = htmlentities($_GET["noserv"]);
$noserv=$var1;
$serviceservice = new ServiceService();
try {
    $data=$serviceservice->search($noserv); 
} catch (ServiceException $we) {
    afficherErreurSynthaxe($we->getCode(), $we->getMessage());
} 

displayDetails2($data);

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>
