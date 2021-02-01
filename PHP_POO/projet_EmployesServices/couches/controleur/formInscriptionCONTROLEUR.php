<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/formInscriptionPRESENTATION.php");
include_once("../service/UserSERVICE.php");
include_once("../metier/User.php");


try { 
    session_start();

$serviceuser = new UserService();

    if (isset($_GET["action"]) && $_GET["action"]=="inscription" && !empty($_POST)) {
        if (isset($_POST["mail"]) && !empty($_POST["mail"])
        && isset($_POST["password"]) && !empty($_POST["password"])) {
            // CONTRE ATTAQUE XSS //
            $var1 = htmlentities($_POST["mail"]);
            $var2 = htmlentities($_POST["password"]);

            $mail=$var1;
            $password=$var2;

            try {
                $data=$serviceuser->searchUser($mail);
            } catch (ServiceException $we) {
                afficherErreurSynthaxe($we->getCode(), $we->getMessage());
            } 

                if (!empty($data) && ($_POST["mail"]) == ($data["mail"])){
                    header('Location: formInscriptionCONTROLEUR.php?warning=mailused');
                } else {
                    $newPassword=$serviceuser->passwordHash($password);
                    try { 
                        $serviceuser->ajoutUser($mail,$newPassword);
                        header('Location: formConnexionCONTROLEUR.php');
                    } catch (ServiceException $se) {
                        afficherErreurAdd($se->getCode(), $se->getMessage());
                    }
                }   
        } else {
            echo "La saisie des champs est obligatoire ! ";
        }
    }

displayInscription1();

    if(isset($_GET['warning']) && $_GET['warning']=='mailused')  {
        displayMailUsed();
    } 

displayInscription2();

} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}


?>