<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Formulaires</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet"> 
</head>

<body>

<?php

//* Référence client (commence par F, contient 9 chiffres mais pas 0) *//
    if ($_GET["action"]=="add") {
        if (!empty($_POST["reference"])) {
            $file = fopen("data.txt", "r+");
            fwrite($file, $_POST["reference"]);
                if (preg_match("#^F[1-9]{9}$#", $_POST["reference"])) {
                    echo "Validé !";
                } else {
                    echo "La référence client est fausse.";
                }
            fclose($file); 
        }
    

//* Numéro de téléphone (commence par 0, contient 10 chiffres) *//
        elseif (!empty($_POST["numero"])) {
            $file = fopen("data.txt", "r+");
            fwrite($file, $_POST["numero"]);
                if (preg_match("#^0[1-9]{9}$#", $_POST["numero"])) {
                    echo "Validé !";
                } else {
                    echo "Le numéro de téléphone n'est pas valide.";
                }
            fclose($file); 
        }


//* Adresse email (format : xx@xx.xx) *//
        elseif (!empty($_POST["email"])) {
            $file = fopen("data.txt", "r+");
            fwrite($file, $_POST["email"]);
                if (preg_match("#[0-9a-z.-_0-9a-z]{2,}@[0-9a-z]{2,}.[a-z]{2,3}$#i", $_POST["email"])) {
                    echo "Validée !";
                } else {
                    echo "L'adresse email n'est pas valide.";
                }
            fclose($file); 
        }


//* Sécurité sociale (13 + 2 chiffres) *//
        elseif (!empty($_POST["secu"])) {
            $file = fopen("data.txt", "r+");
            fwrite($file, $_POST["secu"]);
                if (preg_match("#^[1-2]{1}\s[0-9]{1}[0-9]{1}\s[0-1]{1}[1-9]{1}\s[1-9]{1}[1-9]{1}\s[1-9]{1}[1-9]{1}[1-9]{1}\s[1-9]{1}[1-9]{1}[1-9]{1}\s[1-9]{1}[1-9]{1}$#", $_POST["secu"])) {
                    echo "Validé !";
                } else {
                    echo "Le numéro de sécurité sociale saisi n'est pas valide.";
                }
                fclose($file); 
        }
    }

?>

<div class="container text-center">
    <a href="form.php"><button type="submit" class="btn btn-dark"><strong>Retour</strong></button></a>
</div></br>

</body>
​
</html>