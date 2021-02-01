<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Etat-civil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet"> 
</head>

<body style="background-color:#d8dfe3">

<div class="container text-center">
    <h1 style="font-size:50px;font-family:Berkshire Swash">Fiche de renseignements</h1>
</div></br>

<?php
    $file = fopen("data.txt", "r");
        while (!feof($file)) {
            $line = fgets($file); 
                if (!empty($line)) {
                    $renseignements=explode(";",$line); 
                        if ($renseignements[0]==$_GET["mail"]) {
                            echo

'<div class="container">
    <form action="tab.php?action=edit" method="post">
        <div class="form-group">
            <label for="emailFormControlInput"><strong>Adresse email</strong></label>
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Saisir l\'adresse email" value=' . $renseignements[0] . '>
                </div>
        </div>

        <div class="form-row">
            <div class="form-group col-xl-6">
                <label for="firstNameFormControlInput"><strong>Prénom</strong></label>
                <input type="text" class="form-control" name="prenom" placeholder="Saisir le prénom" value=' . $renseignements[1] . '>
            </div>
            <div class="form-group col-xl-6">
                <label for="nameFormControlInput"><strong>Nom</strong></label>
                <input type="text" class="form-control" name="nom" placeholder="Saisir le nom" value=' . $renseignements[2] . '>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="birthyearFormControlInput"><strong>Année de naissance</strong></label>
                <input type="datetime-local" class="form-control" name="anneenaissance" placeholder="Saisir l\'année de naissance" value=' . $renseignements[4] . '>
            </div>
            <div class="form-group col-md-6">
                <label for="cityFormControlInput"><strong>Ville</strong></label>
                <input type="text" class="form-control" name="ville" placeholder="Saisir la ville" value=' . $renseignements[3] . '>
            </div>
        </div>
</div></br>';
                        }
                    }
                }
?>

<div class="container text-center">
        <button type="submit" class="btn btn-dark"><strong>Mettre à jour</strong></button>
    </form>
</div></br>

</body>

</html>