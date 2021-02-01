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
    <h1 style="font-size:50px;font-family:Berkshire Swash">Etat-civil</h1>
</div></br>

<?php
    if ($_GET["action"]=="add" && !empty($_POST)) {
        if (isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["prenom"]) && !empty($_POST["prenom"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["ville"]) && !empty($_POST["ville"])
        && isset($_POST["anneenaissance"]) && !empty($_POST["anneenaissance"])) {
            $file = fopen("data.txt", "a+");
            fwrite($file, $_POST["email"] . ";" . $_POST["prenom"] . ";" . $_POST["nom"] . ";" . $_POST["ville"] . ";" . $_POST["anneenaissance"] . "\n");
            fclose($file); 
        } else {
        echo "La saisie de tous les champs est obligatoire ! ";
        }
    }

    elseif ($_GET["action"]=="edit") {
        $datas=file_get_contents("data.txt");
        $datas=explode("\n",$datas);
                foreach ($datas as $key => &$line) {
                    $infos=explode(";",$line);
                        if ($infos[0]==$_GET["mail"]) {
                            $line=str_replace($line," ",$datas);
                            file_put_contents("data.txt",$line);
                        }
                }
    }

    elseif ($_GET["action"]=="delete") {
        $datas=file_get_contents("data.txt");
        $datas=explode("\n",$datas);
            foreach ($datas as $key => &$line) {
                $infos=explode(";",$line);
                    if ($infos[0]==$_GET["mail"]) {
                        $line=str_replace($line," ",$datas);
                        file_put_contents("data.txt",$line);
                    }
            }
    }
?>

<div class="container">
    <table class="table">
                <thead class="thead-dark" style="text-align:center">
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Ville</th>
                        <th scope="col">Année de naissance</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="background-color:white;text-align:center">
                    
<?php              
$file = fopen("data.txt", "r");
    while (!feof($file)) {
        $line = fgets($file); 
        if (!empty($line)) {
        $renseignements=explode(";",$line);  

        echo 
        '<tr>
            <td>' . $renseignements[0] . '</td>
            <td>' . $renseignements[1] . '</td>
            <td>' . $renseignements[2] . '</td>
            <td>' . $renseignements[3] . '</td>
            <td>' . $renseignements[4] . '</td>
            <td>' . '<a href="infos.php?action=infos&mail=' . $renseignements[0] . '"><button class="btn btn-info">Détails</button></a>' . '</td>
            <td>' . '<a href="form2.php?action=edit&mail=' . $renseignements[0] . '"><button class="btn btn-warning">Modifier</button></a>' . '</td>
            <td>' . '<a href="tab.php?action=delete&mail=' . $renseignements[0] . '"><button class="btn btn-danger">Supprimer</button></a>' . '</td>
        </tr>';
        }
}
fclose($file);
?>

                </tbody>
    </table>
</div>

<div class="container text-center">
    <a href="form.php"><button type="submit" class="btn btn-dark"><strong>Ajouter</strong></button></a>
</div></br>

</body>
​
</html>