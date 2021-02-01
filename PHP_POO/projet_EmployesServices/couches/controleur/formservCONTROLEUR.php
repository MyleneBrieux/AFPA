<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/formservPRESENTATION.php");
include_once("../service/ServiceSERVICE.php");

// SI UTILISATEUR NON CONNECTE, RETOUR AU FORMULAIRE //
try { 
    session_start();
    if (!isset($_SESSION["mail"])){
        header('Location: formConnexionCONTROLEUR.php');
    }

// FONCTIONS //
$serviceservice = new ServiceService();

    // DANS LE CAS DU ADD //
    if (!empty($_GET) && isset($_GET["action"]) && $_GET["action"]=="add"){
        $action="add";
    }

    // DANS LE CAS DU EDIT //
    elseif (!empty($_GET) && isset($_GET["action"]) && $_GET["action"]=="edit" 
        && isset($_GET["noserv"]) && !empty($_GET["noserv"])){
            $var1 = htmlentities($_GET["noserv"]);
            $noserv=$var1;
            $action="edit";
            try {
                $data=$serviceservice->search($noserv);
            } catch (ServiceException $we) {
                afficherErreurSynthaxe($we->getCode(), $we->getMessage());
            } 
    }


topTagHtml();

displayHead();

topBody();

topContainer();

displayTitle();

topForm1();

    if ($action=="edit") {
        formActionEdit($noserv);
    } else {
        formActionAdd();
    }

topForm2();

topFormNoServ();

    if ($action=="edit") {
        echo 
            $_GET['noserv'];
    }

bottomFormNoServ();

topFormService();

    if ($action=="edit") {
        echo 
            $data->getNomService();
    }

bottomFormService();

topFormVille();

    if ($action=="edit") {
        echo 
            $data->getVille();
    }

bottomFormVille();

btnValider();

bottomForm();

displayBtnReturn();

bottomContainer();

bottomBody();

bottomTagHtml();

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>