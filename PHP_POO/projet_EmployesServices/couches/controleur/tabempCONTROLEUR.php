<?php

// POINT AMELIORATION : pas entièrement en OO. Il faudrait créer une class contrôleur. Or, problème des conditionnements via url (il faudrait 
// créer des instances) => utilisation d'un framework.

// LIAISON AVEC AUTRES COUCHES //
include_once("../presentation/tabempPRESENTATION.php");
include_once("../service/EmployeSERVICE.php");
include_once("../metier/Employe.php");

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
        
        $serviceemploye = new EmployeService();

        // FONCTIONS GLOBALES //
        displayAdminOnly1();


            // COMPTEUR - EMPLOYES AJOUTES AUJOURD'HUI //
            $data=$serviceemploye->searchEmpPerDate();
            echo ("Nombre d'employés ajoutés aujourd'hui : " . $data);

            
            // ON VERIFIE LES ACTIONS ADD, EDIT ET DELETE //
            if (isset($_GET["action"]) && $_GET["action"]=="add" && !empty($_POST)) {
                if (isset($_POST["noemp"]) && !empty($_POST["noemp"])
                    && isset($_POST["noserv"]) && !empty($_POST["noserv"])) {
                    // CONTRE ATTAQUE XSS //
                    $var1 = htmlentities($_POST["noemp"]);
                    $var2 = htmlentities($_POST["nom"]);
                    $var3 = htmlentities($_POST["prenom"]);
                    $var4 = htmlentities($_POST["emploi"]);
                    $var5 = htmlentities($_POST["sup"]);
                    $var6 = htmlentities($_POST["embauche"]);
                    $var7 = htmlentities($_POST["sal"]);
                    $var8 = htmlentities($_POST["comm"]);
                    $var9 = htmlentities($_POST["noserv"]);

                    try {
                        $employe= new Employe (
                        $var1,
                        $var2?$var2:NULL,
                        $var3?$var3:NULL,
                        $var4?$var4:NULL,
                        $var5?$var5:NULL,
                        $var6?$var6:NULL,
                        $var7?$var7:NULL,
                        $var8?$var8:NULL,
                        $var9?$var9:NULL
                        );
                        $serviceemploye->add($employe);
                        displayAddOk();

                    } catch (ServiceException $se) {
                        afficherErreurAdd($se->getCode(), $se->getMessage());
                    }
                }        
            }
            
            elseif (isset($_GET["action"]) && $_GET["action"]=="edit") {
                if (isset($_POST["noemp"]) && !empty($_POST["noemp"])
                    && isset($_POST["noserv"]) && !empty($_POST["noserv"])) {
                    // CONTRE ATTAQUE XSS //
                    $var1 = htmlentities($_POST["noemp"]);
                    $var2 = htmlentities($_POST["nom"]);
                    $var3 = htmlentities($_POST["prenom"]);
                    $var4 = htmlentities($_POST["emploi"]);
                    $var5 = htmlentities($_POST["sup"]);
                    $var6 = htmlentities($_POST["embauche"]);
                    $var7 = htmlentities($_POST["sal"]);
                    $var8 = htmlentities($_POST["comm"]);
                    $var9 = htmlentities($_POST["noserv"]);
            
                    try {
                        $employe= new Employe (
                        $var1 = htmlentities($_POST["noemp"]),
                        $var2?$var2:NULL,
                        $var3?$var3:NULL,
                        $var4?$var4:NULL,
                        $var5?$var5:NULL,
                        $var6?$var6:NULL,
                        $var7?$var7:NULL,
                        $var8?$var8:NULL,
                        $var9?$var9:NULL
                        );
                        $serviceemploye->edit($employe);
                        displayEditOk();
                    } catch (ServiceException $te) {
                        afficherErreurSynthaxe($te->getCode(), $te->getMessage());
                    }
                } 
            }
            
            elseif (isset($_GET["action"]) && $_GET["action"]=="delete") {
                try {
                    $var1 = htmlentities($_GET["noemp"]);
                    $noemp=$var1;
                    $serviceemploye->deleteEmp($noemp);
                    displayDeleteOk();
                } catch (ServiceException $ue) {
                    afficherErreurSup($ue->getCode(), $ue->getMessage());
                }
            }

        // FONCTIONS GLOBALES //
        displayAdminOnly2();

            // FILTRAGE DU TABLEAU //
            // $serviceemploye->searchIntoTable($key,$value);

                try {
                    $rs=$serviceemploye->selectAll();
                } catch (ServiceException $ve) {
                    afficherErreurSynthaxe($ve->getCode(), $ve->getMessage());
                }
        
                while ($data=mysqli_fetch_array($rs)) {
                    displayPublicDatas($data);
                    displayDataSalComm($data);
                    displayNoServBtnDetail($data);
                    btnEditOk($data);
            
                    $noemp=$data["no_emp"];
                    $delete=$serviceemploye->searchEmpNoSup($noemp);
            
                        if( $delete == true){                                         
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
        
        $serviceemploye = new EmployeService();
        
        try {
            $rs=$serviceemploye->selectAll();
        } catch (ServiceException $ve) {
            afficherErreurSynthaxe($ve->getCode(), $ve->getMessage());
        }
        
            while ($data=mysqli_fetch_array($rs)) {
                displayPublicDatas($data);
                displayNoServBtnDetail($data);
                displayPartTableBottom2();
            }

        displayUserOnly2();
    }
} catch (ServiceException $re) {
    afficherErreurBdd($re->getCode(), $re->getMessage());
}

?>