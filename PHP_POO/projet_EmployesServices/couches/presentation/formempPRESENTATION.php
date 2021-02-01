<?php

// GESTION DES ERREURS //
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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

            <title>Formulaire des employés</title>

            <link rel="stylesheet" href="../design/css/styleEMP.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <script src="jquery-3.5.1.min.js"></script>

        </head>';
}

function topTagBody(){
    echo
        '<body>';
}

function topContainer(){
    echo
        '<div class="container">';
}

function displayTitle(){
    echo
        '<h1 class="titre">Informations relatives à l\'employé</h1>';
}

function formActionTop(){
    echo
        '<form action="';
}

function formActionEdit($noemp){
    echo
        "../controleur/tabempCONTROLEUR.php?action=edit&noemp=$noemp";
}

function formActionAdd(){
    echo
        "../controleur/tabempCONTROLEUR.php?action=add";
}

function formActionBottom(){
    echo
        '" method="post">';
}

function formNoEmpTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="noservFormControlInput"><strong>Numéro de l\'employé</strong></label>
                <input type="text" class="form-control" name="noemp" placeholder="Saisir le numéro de l\'employé" value="';
}

function formNoEmpBottom(){
    echo
                '" requirred>
            </div>
        </div>';
}

function formNomTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-6">
                <label for="nomFormControlInput"><strong>Nom de l\'employé</strong></label>
                <input type="text" class="form-control" name="nom" placeholder="Saisir le nom de l\'employé" value="';
}

function formNomBottom(){
    echo
                '">
            </div>';
}

function formPrenomTop(){
    echo
        '<div class="form-group col-xl-6">
            <label for="prenomFormControlInput"><strong>Prénom de l\'employé</strong></label>
            <input type="text" class="form-control" name="prenom" placeholder="Saisir le prénom de l\'employé" value="';
}

function formPrenomBottom(){
    echo
                '">
            </div>
        </div>';
}

function formEmploiTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="emploiFormControlInput"><strong>Intitulé de l\'emploi</strong></label>
                <input type="text" class="form-control" name="emploi" placeholder="Saisir l\'intitulé de l\'emploi" value="';
}

function formEmploiBottom(){
    echo
                '">
            </div>
        </div>';
}

function formSupTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-6">
                <label for="supFormControlInput"><strong>Numéro de l\'employé supérieur</strong></label>
                <input type="text" class="form-control" name="sup" placeholder="Saisir le numéro de l\'employé supérieur" value="';
}

function formSupBottom(){
    echo
            '">
        </div>';
}

function formEmbaucheTop(){
    echo
        '<div class="form-group col-xl-6">
            <label for="embaucheFormControlInput"><strong>Date d\'embauche</strong></label>
            <input type="text" class="form-control" name="embauche" placeholder="Saisir la date d\'embauche" value="';
}

function formEmbaucheBottom(){
    echo
                '">
            </div>
        </div>';
}

function formSalTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-6">
                <label for="salFormControlInput"><strong>Salaire</strong></label>
                <input type="text" class="form-control" name="sal" placeholder="Saisir le salaire" value="';
}

function formSalBottom(){
    echo
            '">
        </div>';
}

function formCommTop(){
    echo
        '<div class="form-group col-xl-6">
            <label for="commFormControlInput"><strong>Commission</strong></label>
            <input type="text" class="form-control" name="comm" placeholder="Saisir la commission" value="';
}

function formCommBottom(){
    echo
                '">
            </div>
        </div>';
}

function formNoServTop(){
    echo
        '<div class="form-row">
            <div class="form-group col-xl-12">
                <label for="noservFormControlInput"><strong>Numéro du service</strong></label>
                <input type="text" class="form-control" name="noserv" placeholder="Saisir le numéro du service" value="';
}

function formNoServBottom(){
    echo
                '">
            </div>
        </div>';
}

function btnValider(){
    echo 
        '<div class="container text-center">
            <button type="submit" id="btnValiderAjout" class="btn btn-dark"><strong>Valider</strong></button>
        </div>';
}

function formBottom(){
    echo                
            '</form>
        </br>';
}

function displayBtnReturn(){
    echo
        '<div class="container text-center">
            <a href="../controleur/tabempCONTROLEUR.php"><button type="submit" class="btn btn-dark">Retour</button></a>
        </div></br>';
}

function bottomContainer(){
    echo
        '</div>';
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
function afficherErreurSynthaxe ($errorCode=null, $message){
    if($errorCode && $errorCode == 1146){ // problème de synthaxe avec une table de la bdd //
        echo 
            "<div class='alert alert-danger text-center'> Erreur de connexion avec la base de données. Merci de réessayer ultérieurement. </div>";
    }
}

?>