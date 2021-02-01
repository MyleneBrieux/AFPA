<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/formempPRESENTATION.php");
include_once("../service/EmployeSERVICE.php");

// GESTION DES ERREURS //
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// SI UTILISATEUR NON CONNECTE, RETOUR AU FORMULAIRE //
try { 
    session_start();
    if (!isset($_SESSION["mail"])){
        header('Location: formConnexionCONTROLEUR.php');
    }

// FONCTIONS //
$serviceemploye = new employeMysqliDao();

    // DANS LE CAS DU ADD //
    if (!empty($_GET) && isset($_GET["action"]) && $_GET["action"]=="add"){
        $action="add";
    }

    // DANS LE CAS DU EDIT //
    elseif (!empty($_GET) && isset($_GET["action"]) && $_GET["action"]=="edit" 
    && isset($_GET["noemp"]) && !empty($_GET["noemp"])){
        try {
            $var1 = htmlentities($_GET["noemp"]);
            $noemp=$var1;
            $action="edit";
            $data=$serviceemploye->search($noemp);
        } catch (ServiceException $we) {
            afficherErreurSynthaxe($we->getCode(), $we->getMessage());
        } 
    }


topTagHtml();

displayHead();

topTagBody();

topContainer();

displayTitle();

formActionTop();

    if ($action=="edit") {
        formActionEdit($noemp);
    } else {
        formActionAdd();
    }

formActionBottom();

formNoEmpTop();

    if ($action=="edit") {
        $var1 = htmlentities($_GET["noemp"]);
            echo 
                $var1;
    }

formNoEmpBottom();

formNomTop();

    if ($action=="edit") {
        echo 
            $data->getNom();
    }

formNomBottom();

formPrenomTop();

    if ($action=="edit") {
        echo 
            $data->getPrenom();
    }

formPrenomBottom();

formEmploiTop();

    if ($action=="edit") {
        echo 
            $data->getEmploi();
    }

formEmploiBottom();

formSupTop();

    if ($action=="edit") {
        echo 
            $data->getSup();
    }

formSupBottom();

formEmbaucheTop();

    if ($action=="edit") {
        echo 
            $data->getEmbauche();
    }

formEmbaucheBottom();

formSalTop();

    if ($action=="edit") {
        echo 
            $data->getSal();
    }

formSalBottom();

formCommTop();

    if ($action=="edit") {
        echo 
            $data->getComm();
    }

formCommBottom();

formNoServTop();

    if ($action=="edit") {
        echo 
            $data->getNoServ();
    }

formNoServBottom();

btnValider();

formBottom();

displayBtnReturn();

bottomContainer();

bottomTagBody();

bottomTagHtml();

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>