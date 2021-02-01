<?php

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
        
            <title>Formulaire des services</title>

            <link rel="stylesheet" href="../design/css/styleSERV.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>';
}

function topBody(){
    echo
        '<body>';
}

function topContainer(){
    echo
        '<div class="container">';
}

function displayTitle(){
    echo
        '<h1 class="titre">Informations relatives au service</h1>';
}

function topForm1(){
    echo
        '<form action="';
}

function formActionEdit($noserv){
    echo
        "../controleur/tabservCONTROLEUR.php?action=edit&noserv=$noserv";
}

function formActionAdd(){
    echo
        "../controleur/tabservCONTROLEUR.php?action=add";
}

function topForm2(){
    echo
        '" method="post">';
}

function topFormNoServ(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="noservFormControlInput"><strong>Numéro du service</strong></label>
                <input type="text" class="form-control" name="noserv" placeholder="Saisir le numéro du service" value="';
}

function bottomFormNoServ(){
    echo
                '" requirred>
            </div>
        </div>';
}

function topFormService(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="serviceFormControlInput"><strong>Nom du service</strong></label>
                <input type="text" class="form-control" name="service" placeholder="Saisir le nom du service" value="';
}

function bottomFormService(){
    echo
                '">
            </div>
    </div>';
}

function topFormVille(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="villeFormControlInput"><strong>Ville du service</strong></label>
                <input type="text" class="form-control" name="ville" placeholder="Saisir la ville du service" value="';
}

function bottomFormVille(){
    echo
                '">
            </div>
        </div>';
}

function btnValider(){
    echo
        '<div class="container text-center">
            <button type="submit" class="btn btn-dark"><strong>Valider</strong></button>
        </div></br>';
}

function bottomForm(){
    echo
        '</form>';
}

function displayBtnReturn(){
    echo
        '<div class="container text-center">
            <a href="../controleur/tabservCONTROLEUR.php">
                <button type="submit" class="btn btn-dark">Retour</button>
            </a>
        </div></br>';
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

function displayNoServ(){
    echo 
        $_GET['noserv'];
}

function displayService($data){
    echo 
        $data['service'];
}

function displayVille($data){
    echo 
        $data['ville'];
}

// gestion des erreurs //
function afficherErreurSynthaxe ($errorCode=null, $message){
    if($errorCode && $errorCode == 1146){ // problème de synthaxe avec une table de la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Erreur de connexion avec la base de données. Merci de réessayer ultérieurement. </div>";
    }
}

?>