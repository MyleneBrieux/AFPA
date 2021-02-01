<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Exercice 1</title>
    <script src="jquery-3.5.1.min.js"></script>
</head>

<body>

    <?php 
        echo "<button id='btn'>Afficher</button>";
    ?>

    <script>

        $("#btn").on("click", function(e){
            $.ajax(
                'exercice1.php',
                {
                    success: function(){
                        const p = document.createElement("p");
                        p.textContent = "Hello World !";
                        document.body.appendChild(p);       
                    },
                    error: function(){
                        window.alert("Erreur !");
                    }
                }
            )  
        });

    </script>

</body>

</html>