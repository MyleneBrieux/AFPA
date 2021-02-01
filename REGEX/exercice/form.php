<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Formulaire</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet"> 
</head>

<body>

<div class="container">
    <h1 style="font-size:50px;font-family:Berkshire Swash;margin-top:20px;text-align:center">Formulaires</h1>
</div></br>


<!-- Référence client -->
<div class="container" style="text-align:center;margin-top:30px">
    <form action="affichage.php?action=add" method="post">
        <div class="form-group col-xl-12">
            <label for="FormControlInput"><strong>Référence client</strong></label>
            <input type="text" class="form-control" name="reference" placeholder="Saisir la référence client">
        </div>

<div class="container text-center">
        <button type="submit" class="btn btn-dark"><strong>Soumettre</strong></button>
    </form>
</div></br>


<!-- Numéro de téléphone -->
<div class="container" style="text-align:center;margin-top:30px">
    <form action="affichage.php?action=add" method="post">
        <div class="form-group col-xl-12">
            <label for="FormControlInput"><strong>Numéro de téléphone</strong></label>
            <input type="text" class="form-control" name="numero" placeholder="Saisir le numéro de téléphone">
        </div>

<div class="container text-center">
        <button type="submit" class="btn btn-dark"><strong>Soumettre</strong></button>
    </form>
</div></br>


<!-- Adresse email -->
<div class="container" style="text-align:center;margin-top:30px">
    <form action="affichage.php?action=add" method="post">
        <div class="form-group col-xl-12">
            <label for="FormControlInput"><strong>Adresse email</strong></label>
            <input type="email" class="form-control" name="email" placeholder="Saisir l'adresse email'">
        </div>

<div class="container text-center">
        <button type="submit" class="btn btn-dark"><strong>Soumettre</strong></button>
    </form>
</div></br>


<!-- Sécurité sociale -->
<div class="container" style="text-align:center;margin-top:30px">
    <form action="affichage.php?action=add" method="post">
        <div class="form-group col-xl-12">
            <label for="FormControlInput"><strong>Numéro de sécurité sociale</strong></label>
            <input type="text" class="form-control" name="secu" placeholder="Saisir le numéro de sécurité sociale">
        </div>

<div class="container text-center">
        <button type="submit" class="btn btn-dark"><strong>Soumettre</strong></button>
    </form>
</div></br>


</body>

</html>