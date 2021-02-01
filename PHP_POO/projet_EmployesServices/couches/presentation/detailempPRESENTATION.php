<?php

// FONCTIONS GLOBALES //
function displayDetails1(){
    topTagHtml();
    displayHead();
    topTagBody();
    displayTitle();
    displayJumbotrom();
}

function displayDetails2(){
    displayJumbotrom2();
    displayBtnReturn();
    bottomTagBody();
    bottomTagHtml();
}


// FONCTIONS EN VRAC //
// affichage //
function topTagHtml(){
    echo
        '<!DOCTYPE html>
            <html>';
}

function displayHead(){
    echo    
        '<head>
            <meta charset="utf-8"/>

            <title>Détails de l\'employé</title>

            <link rel="stylesheet" href="../design/css/styleEMP.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>';
}

function topTagBody(){
    echo
        '<body>';
}

function displayTitle(){
    echo
        '<h1 class="titre" style="margin-left: 425px;">Détails de l\'employé</h1>';
}

function displayJumbotrom(){
    echo
        '<div class="jumbotron text-center">';
}

function displayPublicDetails($data){ 
    echo
        '<h2>' . "NOM : " . $data->getNom() . " | Prénom : " . $data->getPrenom() . '</h2></br>
        <p><strong>Numéro de l\'employé</strong> : ' . $data->getNoEmp() . '</p></br>
        <p><strong>Emploi</strong> : ' . $data->getEmploi() . '</p></br>
        <p><strong>Numéro de l\'employé supérieur</strong> : ' . $data->getSup() . '</p></br>
        <p><strong>Date d\'embauche</strong> : ' . $data->getEmbauche() . '</p></br>';
}

function displaySalComm($data){  
        echo
            '<p><strong>Salaire</strong> : ' . $data->getSal() . "<strong> | Commissions : </strong>" . $data->getComm() . '</p></br>
            <p><strong>Numéro du service </strong> : ' . $data->getNoServ() . '</p></br>';
}

function displayJumbotrom2(){
    echo
        '</div>';
}

function displayBtnReturn(){
    echo
        '<div class="container text-center">
            <a href="../controleur/tabempCONTROLEUR.php"><button type="submit" class="btn btn-dark"><strong>Retour</strong></button></a>
        </div></br>';
}

function bottomTagBody(){
    echo
        '</body>';
}

function bottomTagHtml(){
    echo
        '</html>';
}

// gestion des erreurs //
function afficherErreurBdd ($errorCode=null, $message){
    if($errorCode && $errorCode == 1049){ // erreur de synthaxe sur la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Ce site est en maintenance. Merci de revenir ultérieurement. </div>";
    }
}

function afficherErreurSynthaxe ($errorCode=null, $message){
    if($errorCode && $errorCode == 1146){ // problème de synthaxe avec une table de la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Erreur de connexion avec la base de données. Merci de réessayer ultérieurement. </div>";
    }
}

?>