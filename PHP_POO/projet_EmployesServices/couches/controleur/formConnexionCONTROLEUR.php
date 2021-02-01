<?php

include_once("../presentation/formConnexionPRESENTATION.php");
include_once("../service/UserSERVICE.php");
include_once("../metier/User.php");

try { 
    session_start();

$serviceuser = new UserService();

    if (isset($_GET["action"]) && $_GET["action"]=="connexion" && !empty($_POST)) { 
        if (isset($_POST["mail"]) && !empty($_POST["mail"])
        && isset($_POST["password"]) && !empty($_POST["password"])) {
            // CONTRE ATTAQUE XSS //
            $var1 = htmlentities($_POST["mail"]);
            $var2 = htmlentities($_POST["password"]);
            
            $mail=$var1;
            $password=$var2;

            try {
                $data=$serviceuser->searchUser($mail);
                    if ($passwordOk=$serviceuser->passwordVerify($password,$data)){
                        $_SESSION["mail"]=$mail;
                        $_SESSION["profil"]=$data["profil"];
                        header('Location: tabempCONTROLEUR.php');
                    } else {
                        header('Location: formConnexionCONTROLEUR.php?warning=failconnexion');
                    }
            } catch (ServiceException $we) {
                afficherErreurSynthaxe($we->getCode(), $we->getMessage());
            } 
            

        }
    }

displayConnexion1();

    if (isset($_GET['warning']) && $_GET['warning']=='failconnexion') {
        displayConnexionKo();
    } 

displayConnexion2();

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>