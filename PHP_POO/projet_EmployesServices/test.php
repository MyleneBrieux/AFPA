<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// CONNEXION BDD //
// try{
//     $mysqli = new mysqli('localhost','root','','entrprise'); // erreur provoquée sur "entreprise"
// } catch(mysqli_sql_exception $e){
//     echo "Code : " . $e->getCode() . " / Message : " . $e->getMessage();
// }


// AJOUT EMPLOYE //
try{
    $mysqli = new mysqli('localhost','mylene','afpamy13','entreprise');
    $stmt=$mysqli->prepare('insert into employes(no_emp,nom,prenom,emploi,sup,embauche,sal,comm,no_serv) 
                            values("1615","BRIEUX","MYLENE",null,"1000",null,null,null,"5")'); // erreur provoquée sur "employes"
    $stmt->execute();
    $mysqli->close();
}catch(mysqli_sql_exception $m){
    echo "Code : " . $m->getCode() . " / Message : " . $m->getMessage();
}


// SUPPRESSION EMPLOYE//
// try{
//     $mysqli = new mysqli('localhost','mylene','afpamy13','entreprise');
//     $stmt=$mysqli->prepare('delete from employe where no_emp=3000'); // erreur provoquée sur "employes"
//     $stmt->execute();
//     $mysqli->close();
// }catch(mysqli_sql_exception $m){
//     echo "Code : " . $m->getCode() . " / Message : " . $m->getMessage();
// }

?>