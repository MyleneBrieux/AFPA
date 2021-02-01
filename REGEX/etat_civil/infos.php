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
    <h1 style="font-size:50px;font-family:Berkshire Swash">Informations</h1>
</div></br>

<div class="jumbotron">
    <div class="container text-center">
        <?php
            $file = fopen("data.txt", "r");
                while (!feof($file)) {
                    $line = fgets($file); 
                        if (!empty($line)) {
                            $renseignements=explode(";",$line); 
                                if ($renseignements[0]==$_GET["mail"]) {
                                    echo
                                        '<h2>' . $renseignements[1] . " " . $renseignements[2] . '</h2></br>
                                        <p><strong>Adresse email</strong> : ' . $renseignements[0] . '</p></br>
                                        <p><strong>Ville</strong> : ' . $renseignements[3] . '</p></br>
                                        <p><strong>Année de naissance</strong> : ' . $renseignements[4] . '</p>' ;
                                }
                        }
                }
        ?>
    </div>
</div>

<div class="container text-center">
    <a href="tab.php"><button type="submit" class="btn btn-dark"><strong>Retour</strong></button></a>
</div></br>

</body>
​
</html>