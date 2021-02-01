<?php

// GESTION DES ERREURS //
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
    displayTableColumnsTop();
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
        
            <title>Services</title>

            <link rel="stylesheet" href="../design/css/styleSERV.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                                <a class="nav-link" href="../controleur/tabempCONTROLEUR.php">Employés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
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
                <h1 class="titre" style="margin-left: 450px;">Services</h1>';
}

function displayBtnAdd(){
    echo
        '<a href="../controleur/formservCONTROLEUR.php?action=add" style="margin-top: 116px;"><button type="submit" style="margin-left: 380px;" 
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
                <h1 class="titre" style="margin-left: 450px;">Services</h1>
        </div>';
}

function displayTableColumnsTop(){
    echo
        '<table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NO_SERV</th>
                    <th scope="col">SERVICE</th>
                    <th scope="col">VILLE</th>
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
                    <th scope="col">NO_SERV</th>
                    <th scope="col">SERVICE</th>
                    <th scope="col">VILLE</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
        <tbody>';
}

function displayPublicDatas($data){
    echo
        '<tr>
            <td>' . $data["no_serv"] . '</td>
            <td>' . $data["service"] . '</td>
            <td>' . $data["ville"] . '</td>
            <td>' . '<a href=../controleur/detailservCONTROLEUR.php?action=infos&noserv=' . $data["no_serv"] . '><button class="btn btn-info">Détails</button></a>' . '</td>';
}

function btnEdit($data){
    echo
        '<td>' . '<a href=../controleur/formservCONTROLEUR.php?action=edit&noserv=' . $data["no_serv"] . '><button class="btn btn-warning">Modifier</button></a>' . '</td>
        <td>' ;
}

function btnSupOk($data){
    echo   
        '<a href="../controleur/tabservCONTROLEUR.php?action=delete&noserv=' . $data["no_serv"] . '"><button class="btn btn-danger">Supprimer</button></a>';
}

function btnSupKo(){
    echo
        "Ne peut être supprimé";
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

function displayPublicDatasUserOnly($data){
    echo
                '<tr>
                    <td>' . $data["no_serv"] . '</td>
                    <td>' . $data["service"] . '</td>
                    <td>' . $data["ville"] . '</td>
                    <td>' . '<a href=../controleur/detailservCONTROLEUR.php?action=infos&noserv=' . $data["no_serv"] . '>
                        <button class="btn btn-info">Détails</button></a>' . 
                    '</td>
                    </td>
                </tr>
            </tbody>
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

// gestion des erreurs //
function displayAddOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Service ajouté avec succès ! </p>
        </div>';
}

function displayEditOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Service modifié avec succès ! </p>
        </div>';
}

function displayDeleteOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Service supprimé avec succès ! </p>
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
            "<div class='alert alert-danger text-center'> Ce numéro de service est déjà attribué ! </div>";
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
            "<div class='alert alert-danger text-center'> Vous ne pouvez pas supprimer ce service ! </div>";
    }
}

?>