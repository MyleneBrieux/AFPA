<?php

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/tabservPRESENTATION.php");
include_once("../service/ServiceSERVICE.php");
include_once("../metier/Service.php");

// GESTION DES ERREURS //
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// SI UTILISATEUR NON CONNECTE, RETOUR AU FORMULAIRE //
try { 
    session_start();
    if (!isset($_SESSION["mail"])){
        header('Location: formConnexionCONTROLEUR.php');
    }
        // SI PROFIL ADMINISTRATEUR //
        if (isset($_SESSION['mail']) && $_SESSION['profil'] == "admin") {       
        
            $serviceservice = new ServiceService();

            // FONCTIONS GLOBALES //
            displayAdminOnly1();
    
                // ON VERIFIE LES ACTIONS ADD, EDIT ET DELETE //
                if (isset($_GET["action"]) && $_GET["action"]=="add" && !empty($_POST)) {
                    if (isset($_POST["noserv"]) && !empty($_POST["noserv"])) {
                        // CONTRE ATTAQUE XSS //
                        $var1 = htmlentities($_POST["noserv"]);
                        $var2 = htmlentities($_POST["service"]);
                        $var3 = htmlentities($_POST["ville"]);

                        try { 
                            $service = new Service (
                                $var1, 
                                $var2?$var2:NULL,
                                $var3?$var3:NULL
                            );
                            $service=$serviceservice->add($service);
                            displayAddOk();

                        } catch (ServiceException $se) {
                            afficherErreurAdd($se->getCode(), $se->getMessage());
                        }
                        
                    } 
                }
                    
                elseif (isset($_GET["action"]) && $_GET["action"]=="edit") {
                    if (isset($_POST["noserv"]) && !empty($_POST["noserv"])) {
                        // CONTRE ATTAQUE XSS //
                        $var1 = htmlentities($_POST["noserv"]);
                        $var2 = htmlentities($_POST["service"]);
                        $var3 = htmlentities($_POST["ville"]);

                        $service = new Service (
                            $var1, 
                            $var2?$var2:NULL,
                            $var3?$var3:NULL
                            );
                        try {  
                            $service=$serviceservice->edit($service);
                            displayEditOk();
                        } catch (ServiceException $te) {
                            afficherErreurSynthaxe($te->getCode(), $te->getMessage());
                        }
                    } 
                }
   
                elseif (isset($_GET["action"]) && $_GET["action"]=="delete") {
                    $var1 = htmlentities($_GET["noserv"]);
                    $noserv=$var1;
                    $serviceservice->deleteServ($noserv);
                    try {
                        displayDeleteOk();
                    } catch (ServiceException $ue) {
                        afficherErreurSup($ue->getCode(), $ue->getMessage());
                    }
                }

        // FONCTIONS GLOBALES //
        displayAdminOnly2();

        try {
            $rs=$serviceservice->selectAll();
        } catch (ServiceException $ve) {
            afficherErreurSynthaxe($ve->getCode(), $ve->getMessage());
        }
        
        while ($data=mysqli_fetch_array($rs)) {
            displayPublicDatas($data);
            btnEdit($data);
                                
            $noserv= $data["no_serv"];  
            $info=$serviceservice->searchNoServNotAffected($noserv);
    
                if( $info["no_serv"] != $noserv){ 
                    btnSupOk($data);
                } else {
                    btnSupKo();
                }
            displayPartTableBottom1();
        }

        displayAdminOnly3();

    // SI PROFIL UTILISATEUR //
    } else {

        // FONCTIONS GLOBALES //
        displayUserOnly1();
        
        $serviceservice = new ServiceService();
        $rs=$serviceservice->selectAll();
        
            while ($data=mysqli_fetch_array($rs)) {
                displayPublicDatas($data);
                displayPartTableBottom2();
            }

        displayUserOnly2();

    }
    
} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>