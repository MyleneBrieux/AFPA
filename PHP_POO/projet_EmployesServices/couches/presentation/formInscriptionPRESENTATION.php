<?php

// FONCTION GLOBALE //
function displayInscription1(){
    topTagHtml();
    displayHead();
    topBody();
    displayTitle();
}

function displayInscription2(){
    displayForm();
    displayBtnInscription();
    displayBtnConnexion();
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
            <title>Formulaire d\'inscription</title>
        
            <link rel="stylesheet" href="../design/css/styleUSER.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
            <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet"> 
    
        </head>';
}

function topBody(){
    echo
        '<body>';
}

function displayTitle(){
    echo
        "<div class='container text-center'>
            <h1 class='titre'>Formulaire d'inscription</h1>
        </div></br>";
}

function displayForm(){
    echo
        '<div class="container">
        <form action="../controleur/formInscriptionCONTROLEUR.php?action=inscription" method="post">
            <div class="form-group">
                <label for="emailFormControlInput"><strong>Adresse email</strong></label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">@</span>
                        </div>
                        <input type="email" class="form-control" name="mail" placeholder="Saisir une adresse email">
                    </div>
            </div>

            <div class="form-group">
                <label for="passwordFormControlInput"><strong>Mot de passe</strong></label>
                <input type="password" class="form-control" name="password" placeholder="Saisir un mot de passe">
            </div></br>';
}

function displayBtnInscription(){
    echo
                '<div class="container text-center">
                <button type="submit" class="btn btn-dark"><strong>S\'inscrire</strong></button>
            </form>
        </div></br>';
}

function displayBtnConnexion(){
    echo
        '<div class="container text-center">
            <a href="../controleur/formConnexionCONTROLEUR.php">
                <button type="submit" class="btn btn-dark">Se connecter</button>
            </a>
        </div></br>';
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

function displayInscrOk(){
    echo
        '<div class="alert alert-success col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Inscription réussie, vous pouvez désormais vous connecter. </p>
        </div>';
}

function displayMailUsed(){
    echo
        '<div class="alert alert-danger col-6 offset-3 mt-2 m3-2" role="alert">
            <p class="text-center p-0 m-0"> Cette adresse email est déjà utilisée ! </p>
        </div>';
}

?>
