<?php

// POINT AMELIORATION : génant d'avoir du php. On pourrait utiliser un moteur de templates (Twig dans Symfony). L'écriture serait plus simple
// => utilisation d'un framework.

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// FONCTIONS GLOBALES ADMINISTRATEUR //
function displayAdminOnly1(){
    topTagHtml();
    displayHead();
    topBody();
    displayNavbar();
    displayTitleTop();
    displayBtnAdd();
    displayTitleBottom();
}

function displayAdminOnly2(){
    displayRechercheNom();
    displayRecherchePrenom();
    displayRechercheEmploi();
    displayRechercheNomService();
    displayTableColumnsTop();
    displayColSalComm();
    displayTableColumnsMiddle();
    displayColModSup();
    displayTableColumnsBottom();
}

function displayAdminOnly3(){
    displayTableRowsBottom();
    bottomContainer();
    bottomBody();
    bottomTagHtml();
}


// FONCTIONS GLOBALES UTILISATEUR //
function displayUserOnly1(){
    topTagHtml();
    displayHead();
    topBody();
    displayNavbar();
    displayTitleUserOnly();
    displayColUserOnly();
}

function displayUserOnly2(){
    displayPartTableBottom2();
    bottomContainer();
    bottomBody();
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
        
            <title>Employés</title>

            <link rel="stylesheet" href="../design/css/styleEMP.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <script src="../js/jquery-3.5.1.min.js"></script>
            <script src="../js/script.js"></script>

            <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
        </head>';
}

function topBody(){
    echo
        '<body>';
}

function displayNavbar(){
    echo
        '<div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="#">AFPA</a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Employés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../controleur/tabservCONTROLEUR.php">Services</a>
                            </li>
                            <li class="nav-item active">
                                <a href="../controleur/deconnexionCONTROLEUR.php" class="nav-link" style="padding-left: 62.5rem;">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
            </nav>
        </div>';
}

function displayTitleTop(){
    echo
        '<div class="container">
            <div class="row">
                <h1 class="titre" id="titre" style="margin-left: 425px;">Employés</h1>';
}

function displayBtnAdd(){
    echo
        '<a href="../controleur/formempCONTROLEUR.php?action=add" style="margin-top: 115px;"><button type="submit" style="margin-left: 380px;" 
        class="btn btn-success"><strong>Ajouter</strong></button></a>';
}

function displayTitleBottom(){
    echo
        '</div>';
}

function displayTitleUserOnly(){
    echo 
    '<div class="container">
        <div class="row">
                <h1 class="titre" style="margin-left: 425px;">Employés</h1>
        </div>';
}

function displayTableColumnsTop(){
    echo
        '<table id="table" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NO_EMP</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMPLOI</th>
                    <th scope="col">SUP</th>
                    <th scope="col">EMBAUCHE</th>';
}

function displayColSalComm(){
    echo
        '<th scope="col">SAL</th>
        <th scope="col">COMM</th>';
}

function displayTableColumnsMiddle(){
    echo
        '<th scope="col">NO_SERV</th>
        <th scope="col">Détails</th>';
}

function displayColModSup(){
    echo
        '<th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>';
}

function displayTableColumnsBottom(){
    echo
                '</tr>
            </thead>
        <tbody>';
}

function displayColUserOnly(){
    echo
        '<table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NO_EMP</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMPLOI</th>
                    <th scope="col">SUP</th>
                    <th scope="col">EMBAUCHE</th>
                    <th scope="col">NO_SERV</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
        <tbody id="tbody">';
}

function displayPublicDatas($data){
    echo
        '<tr>
            <td> '. $data["no_emp"] . '</td>
            <td>' . $data["nom"] . '</td>
            <td>' . $data["prenom"] . '</td>
            <td>' . $data["emploi"] . '</td>
            <td>' . $data["sup"] . '</td>
            <td>' . $data["embauche"] . '</td>';
 }

function displayNoServBtnDetail($data){
    echo
        '<td>' . $data["no_serv"] . '</td>
        <td>' . '<a href=../controleur/detailempCONTROLEUR.php?action=infos&noemp=' . $data["no_emp"] . '><button class="btn btn-info">Détails</button></a>' . '</td>';
}

function displayDataSalComm($data){
    echo
        '<td>' . $data["sal"] . '</td>
        <td>' . $data["comm"] . '</td>';
}

function btnEditOk($data){
    echo
        '<td>' . '<a href=../controleur/formempCONTROLEUR.php?action=edit&noemp=' . $data["no_emp"] . '><button class="btn btn-warning">Modifier</button></a>' . '</td>
        <td>';    
}

function btnSupOk($data){
    echo   
        '<a href="../controleur/tabempCONTROLEUR.php?action=delete&noemp=' . $data["no_emp"] . '"><button class="btn btn-danger">Supprimer</button></a>';
}

function btnSupKo(){
    echo
        "Ne peut être supprimé(e)";
}

function displayPartTableBottom1(){
    echo
        '</td>';
}

function displayPartTableBottom2(){
    echo
        '</tr>';
}


function displayTableRowsBottom(){
    echo
            '</tbody>
        </table>';
}

function bottomContainer(){
    echo
        '</div>';
}

function bottomBody(){
    echo
        '</body>';
}

function bottomTagHtml(){
    echo
        '</html>';
}

// système de filtration //
function displayRechercheNom(){
    echo 
        '</br>
        <input type="search" id="filtrerNom" placeholder="Filtrer par nom">';
}

function displayRecherchePrenom(){
    echo 
        '<input type="search" id="filtrerPrenom" placeholder="Chercher par prénom"></br>';
}

function displayRechercheEmploi(){
    echo 
        '<input type="search" id="filtrerEmploi" placeholder="Chercher par emploi">';
}

function displayRechercheNomService(){
    echo 
        '<input type="search" id="filtrerNomService" placeholder="Chercher par nom de service"></br>';
}

// gestion des erreurs //
function displayAddOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Employé ajouté avec succès ! </p>
        </div>';
}

function displayEditOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Employé modifié avec succès ! </p>
        </div>';
}

function displayDeleteOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Employé supprimé avec succès ! </p>
        </div>';
}

function afficherErreurBdd ($errorCode=null, $message){
    if($errorCode && $errorCode == 1049){ // erreur de synthaxe sur la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Ce site est en maintenance. Merci de revenir ultérieurement. </div>";
    }
}

function afficherErreurAdd ($errorCode=null, $message){
    if($errorCode && $errorCode == 1062){
        echo 
            "<div class='alert alert-danger text-center'> Ce numéro d'employé' est déjà attribué ! </div>";
    }
}

function afficherErreurSynthaxe ($errorCode=null, $message){
    if($errorCode && $errorCode == 1146){ // problème de synthaxe avec une table de la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Erreur de connexion avec la base de données. Merci de réessayer ultérieurement. </div>";
    }
}

function afficherErreurSup ($errorCode=null, $message){
    if($errorCode && $errorCode == 1451){ 
        echo 
            "<div class='alert alert-danger text-center'> Vous ne pouvez pas supprimer cet employé ! </div>";
    }
}

?>