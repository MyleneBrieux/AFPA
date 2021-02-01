// on keyup : ajax avec colonne => val de l'inputs : nom => "LEROY"&prenom="PAUL&..." 

$.ajax(
    '../controleur/tabempCONTROLEUR.php',
        {
            $('input').on('keyup', function(e){
                const id = e.currentTarget.id;
                const content = e.target.value;
                let url = "../controleur/tabempCONTROLEUR.php?id="+id+"&content="+content;
            })
    })