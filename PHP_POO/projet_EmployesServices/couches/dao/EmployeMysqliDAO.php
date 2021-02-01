<?php

// POINT AMELIORATION : donner un objet à mysqli plutôt que des requêtes. Or, mysqli ne propose pas ça. Il faudrait gérer la correspondance/mapping
// entre class employé et table employés (attribut no_emp correspond à la colonne no_emp, etc) => utilisation d'un framework.

// LIAISONS AVEC AUTRES COUCHES //
include_once("../metier/Employe.php");
include_once("DaoEmpINTERFACE.php");

// GESTION DES ERREURS //
include_once("DaoException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    class EmployeMysqliDao implements DaoEmpInterface {

        public function connexion() {
            try {
                $mysqli= new mysqli('localhost','mylene','afpamy13','entreprise');
                return $mysqli;
            } catch (mysqli_sql_exception $d) {
                throw new DaoException($d->getMessage(), $d->getCode());
            }
        }
        
        public function add(object $gestion) : void {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare("insert into employes(no_emp, nom, prenom, emploi, sup, embauche, sal, comm, no_serv, date_ajout) values(?,?,?,?,?,?,?,?,?,?)");
                $noemp=$gestion->getNoemp();
                $nom=$gestion->getNom();
                $prenom=$gestion->getPrenom();
                $emploi=$gestion->getEmploi();
                $sup=$gestion->getSup();
                $embauche=$gestion->getEmbauche();
                $sal=$gestion->getSal();
                $comm=$gestion->getComm();
                $noserv=$gestion->getNoserv();
                $date_ajout=date('Y-m-d');
                $stmt->bind_param("isssisddis", $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv,$date_ajout);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $e){
                throw new DaoException($e->getMessage(),$e->getCode());
            }
        }

        public function searchEmpPerDate() {
            $mysqli=$this->connexion();
            $date_ajout=date('Y-m-d');
            $stmt=$mysqli->prepare("select * from employes where date_ajout='" . $date_ajout ."' ");
            $stmt->execute();
            $rs=$stmt->get_result();
            $data=mysqli_num_rows($rs);
            $mysqli->close();
            return $data;
        }

        // public function searchIntoTable($key,$value){
        //     $mysqli=$this->connexion();
        //     $stmt=$mysqli->prepare("select * from employes as E inner join services as S on e.no_serv=s.no_serv where");
        //         if($params){
        //             $i=0;
        //                 foreach($params as $key => $value){
        //                     if($i>0){
        //                         $stmt = $stmt . "and";
        //                     }
        //                     $stmt = $stmt . $key . " ='%" . $value . "%' ";
        //                     $i++;
        //                 }
        //         }
        //     $stmt->execute();
        //     $rs=$stmt->get_result();
        //     $data=$rs->fetch_all(MYSQLI_ASSOC);
        //     $rs->free();
        //     $mysqli->close();
        //     return $data;
        // }
        
        public function edit(object $gestion) : void {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare("update employes set no_emp=?, nom=?, prenom=?, emploi=?, sup=?, embauche=?, sal=?, comm=?, no_serv=? where no_emp=?");
                $noemp=$gestion->getNoemp();
                $nom=$gestion->getNom();
                $prenom=$gestion->getPrenom();
                $emploi=$gestion->getEmploi();
                $sup=$gestion->getSup();
                $embauche=$gestion->getEmbauche();
                $sal=$gestion->getSal();
                $comm=$gestion->getComm();
                $noserv=$gestion->getNoserv();
                $stmt->bind_param("isssisddii", $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv, $noemp);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $f) {
                throw new DaoException($f->getMessage(), $f->getCode());
            }
        }
        
        public function deleteEmp(int $noemp) : void {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare("delete from employes where no_emp=?");
                $stmt->bind_param("i", $noemp);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $g) {
                throw new DaoException($g->getMessage(), $g->getCode());
            }
        }
        
        public function search(int $gestion) : object {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare('select * from employes where no_emp=?');
                $noemp=$_GET["noemp"];
                $stmt->bind_param("i", $noemp);
                $stmt->execute();
                $rs=$stmt->get_result();
                $data=$rs->fetch_array(MYSQLI_ASSOC);
                $nom=$data["nom"];
                $prenom=$data["prenom"];
                $emploi=$data["emploi"];
                $sup=$data["sup"];
                $embauche=$data["embauche"];
                $sal=$data["sal"];
                $comm=$data["comm"];
                $noserv=$data["no_serv"];
                $employe = new Employe($noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv);
                $employe->setNoEmp($data["no_emp"]);
                $rs->free();
                $mysqli->close();
                return $employe;
            } catch (mysqli_sql_exception $h) {
                throw new DaoException($h->getMessage(), $h->getCode());
            }
        }
        
        public function selectAll() {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare('select * from employes');
                $stmt->execute();
                $rs=$stmt->get_result();
                return $rs;
                $rs->free();
                $mysqli->close();
            } catch (mysqli_sql_exception $i) {
                throw new DaoException($i->getMessage(), $i->getCode());
            }
        }
        
        public function searchEmpNoSup(int $noemp) : ?bool {
            $mysqli=$this->connexion();
            $stmt=$mysqli->prepare('select distinct sup from employes where no_emp=?'); // RECHERCHE SI LE SUP EST NON NULL
            $stmt->bind_param("i", $noemp);
            $stmt->execute();
            $data=$stmt->get_result();
            $info=$data->fetch_array(MYSQLI_ASSOC);
                if(!isset($info["sup"])) { // S'IL N'A PAS DE SUP, NE PAS SUPPRIMER
                    $delete = false;
                } 
                else{ 
                    $stmt=$mysqli->prepare('select distinct sup from employes where sup=?'); // SI LA CASE SUP EST REMPLIE, ALORS SUP A QQN
                    $stmt->bind_param("i", $noemp);
                    $stmt->execute();
                    $data=$stmt->get_result();
                    $donnee=$data->fetch_array(MYSQLI_ASSOC);
                    if(isset($donnee)) { // S'IL N'A PAS DE SUP
                        $delete = false; 
                    }
                    else {
                        $delete = true;
                    }
                }
            return $delete;
            $nom=$data["nom"];
            $prenom=$data["prenom"];
            $emploi=$data["emploi"];
            $sup=$data["sup"];
            $embauche=$data["embauche"];
            $sal=$data["sal"];
            $comm=$data["comm"];
            $noserv=$data["no_serv"];
            $employe = new Employe($noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv);
            $employe->setSup($data["sup"]);
            $data->free();
            $mysqli->close();
            return $employe;
        }

    }



// STYLE PROCEDURAL
// function connexion() {
//     $db=mysqli_init();
//     mysqli_real_connect($db,'localhost','mylene','afpamy13','entreprise');
// }

// function addEmp() {
//     connexion();
//     $noemp=$_POST["noemp"];
//     $nom=$_POST["nom"]?"'" . $_POST["nom"] . "'":'NULL';
//     $prenom=$_POST["prenom"]?"'" . $_POST["prenom"] . "'":'NULL';
//     $emploi=$_POST["emploi"]?"'" . $_POST["emploi"] . "'":'NULL';
//     $sup=$_POST["sup"]?"'" . $_POST["sup"] . "'":'NULL';
//     $embauche=$_POST["embauche"]?"'" . $_POST["embauche"] . "'":'NULL';
//     $sal=$_POST["sal"]?"'" . $_POST["sal"] . "'":'NULL';
//     $comm=$_POST["comm"]?"'" . $_POST["comm"] . "'":'NULL';
//     $noserv=$_POST["noserv"];
//     $query="insert into employes values($noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv)";
//     $db=connexion();
//     $rs=mysqli_query($db,$query); 
//     mysqli_close($db);
// }

// function editEmp() {
//     connexion();
//     $noemp=$_POST["noemp"];
//     $nom=$_POST["nom"]?"'" . $_POST["nom"] . "'":'NULL';
//     $prenom=$_POST["prenom"]?"'" . $_POST["prenom"] . "'":'NULL';
//     $emploi=$_POST["emploi"]?"'" . $_POST["emploi"] . "'":'NULL';
//     $sup=$_POST["sup"]?"'" . $_POST["sup"] . "'":'NULL';
//     $embauche=$_POST["embauche"]?"'" . $_POST["embauche"] . "'":'NULL';
//     $sal=$_POST["sal"]?"'" . $_POST["sal"] . "'":'NULL';
//     $comm=$_POST["comm"]?"'" . $_POST["comm"] . "'":'NULL';
//     $noserv=$_POST["noserv"];
//     $queryupdate="update employes set no_emp=$noemp, nom=$nom, prenom=$prenom, emploi=$emploi, sup=$sup, embauche=$embauche, sal=$sal, comm=$comm, no_serv=$noserv where no_emp=$noemp";
//     $db=connexion();
//     $rs=mysqli_query($db,$queryupdate); 
//     mysqli_close($db);
// }
//
// function deleteEmp() {
//     connexion();
//     $noemp=$_GET["noemp"];
//     $querydel="delete from employes where no_emp=$noemp";
//     $db=connexion();
//     mysqli_query($db,$querydel);
//     mysqli_close($db);
// }

// function searchEmp() {
//     connexion();
//     $noemp=$_GET["noemp"];
//     $db=connexion();
//     $rs=mysqli_query($db, 'select * from employes');
//         while ($data=mysqli_fetch_row ($rs)) {
//             if ($data[0]==$noemp) {
//                 echo
//                     '<h2>' . "NOM : " . $data[1] . " | Prénom : " . $data[2] . '</h2></br>
//                     <p><strong>Numéro de l\'employé</strong> : ' . $data[0] . '</p></br>
//                     <p><strong>Emploi</strong> : ' . $data[3] . '</p></br>
//                     <p><strong>Numéro de l\'employé supérieur</strong> : ' . $data[4] . '</p></br>
//                     <p><strong>Date d\'embauche</strong> : ' . $data[5] . '</p></br>';
//                         if(isset($_SESSION['mail']) && $_SESSION['profil'] == "admin"){
//                             echo
//                     '<p><strong>Salaire</strong> : ' . $data[6] . "<strong> | Commissions : </strong>" . $data[7] . '</p></br>
//                     <p><strong>Numéro du service </strong> : ' . $data[8] . '</p></br>';
//                         }
//             }
//         }
//     mysqli_free_result($rs);     
//     mysqli_close($db); 
//     return $rs;
// }

// function searchEmpNoSup() {
//     $db=connexion();
//     $query="select distinct sup from employes";
//     $rs=mysqli_query($db,$query);
//     $info=mysqli_fetch_all ($rs, MYSQLI_ASSOC);
//     mysqli_free_result($rs);
//     mysqli_close($db);
//     return $info;
// }

?>