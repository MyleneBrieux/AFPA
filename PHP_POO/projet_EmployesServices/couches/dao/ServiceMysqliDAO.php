<?php

// LIAISONS AVEC AUTRES COUCHES //
include_once("../metier/Service.php");
include_once("DaoServINTERFACE.php");

// GESTION DES ERREURS // 
include_once("DaoException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    class ServiceMysqliDao implements DaoServInterface {

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
                $stmt=$mysqli->prepare("insert into services(no_serv,service,ville) values(?,?,?)");
                $noserv=$gestion->getNoserv();
                $nomService=$gestion->getNomService();
                $ville=$gestion->getVille();
                $stmt->bind_param("iss", $noserv, $nomService, $ville);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $e) {
                throw new DaoException($e->getMessage(), $e->getCode());
            }
        }
        
        public function edit(object $gestion) : void {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare("update services set no_serv=?, service=?, ville=? where no_serv=?");
                $noserv=$gestion->getNoserv();
                $nomService=$gestion->getNomService();
                $ville=$gestion->getVille();
                $stmt->bind_param("issi", $noserv, $nomService, $ville, $noserv);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $f) {
                throw new DaoException($f->getMessage(), $f->getCode());
            }
        }
        
        public function deleteServ(int $noserv) : void {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare("delete from services where no_serv=?");
                $stmt->bind_param("i", $noserv);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $g) {
                throw new DaoException($g->getMessage(), $g->getCode());
            }

        }
        
        public function search(int $gestion) : object {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare('select * from services where no_serv=?');
                $noserv=$_GET["noserv"];
                $stmt->bind_param("i", $noserv);
                $stmt->execute();
                $rs=$stmt->get_result();
                $data=$rs->fetch_array(MYSQLI_ASSOC);
                $service=$data["service"];
                $ville=$data["ville"];
                $service = new Service($noserv,$service,$ville);
                $service->setNoServ($data["no_serv"]);
                $rs->free();
                $mysqli->close();       
                return $service;  
            } catch (mysqli_sql_exception $h) {
                throw new DaoException($h->getMessage(), $h->getCode());
            }
        } 
        
        public function selectAll() {
            try {
                $mysqli=$this->connexion();
                $stmt=$mysqli->prepare('select * from services');
                $stmt->execute();
                $rs=$stmt->get_result();
                return $rs;
                $rs->free();
                $mysqli->close();
            } catch (mysqli_sql_exception $i) {
                throw new DaoException($i->getMessage(), $i->getCode());
            }
        }
        
        public function searchNoServNotAffected(int $noserv) : array {
            $mysqli=$this->connexion();
            /*$stmt=$mysqli->prepare("select distinct no_serv from services where no_serv not in (select distinct no_serv from employes where no_serv=?)");*/
            $stmt=$mysqli->prepare('select distinct no_serv from employes where no_serv=?'); 
            $stmt->bind_param("i", $noserv);
            $stmt->execute();
            $data=$stmt->get_result();
            $info=$data->fetch_array(MYSQLI_ASSOC);
                if(!isset($info)) {
                    $info["no_serv"] = 0; // SI INFO N'A PAS TROUVE UNE ENTREE DANS LA TABLE, N'AFFICHERA RIEN
                } 
            return $info;
            $data->free();
            $mysqli->close();
        }

}

// STYLE PROCEDURAL //
// function connexion() {
//     $db=mysqli_init();
//     mysqli_real_connect($db, 'localhost','mylene','afpamy13','entreprise');
//     return $db;
// }

// function addServ() {
//     $db=connexion();
//     $noserv=$_POST["noserv"];
//     $service=$_POST["service"]?"'" . $_POST["service"] . "'":'NULL';
//     $ville=$_POST["ville"]?"'" . $_POST["ville"] . "'":'NULL';
//     $query="insert into services values($noserv,$service,$ville)";
//     $rs=mysqli_query($db,$query); 
//     mysqli_close(mysqli_init());
// }

// function editServ() {
//     $db=connexion();
//     $noserv=$_POST["noserv"];
//     $service=$_POST["service"]?"'" . $_POST["service"] . "'":'NULL';
//     $ville=$_POST["ville"]?"'" . $_POST["ville"] . "'":'NULL';
//     $queryupdate="update services set no_serv=$noserv, service=$service, ville=$ville where no_serv=$noserv";
//     $rs=mysqli_query($db,$queryupdate); 
//     mysqli_close($db);
// }

// function deleteServ($noserv) {
//     $db=connexion();
//     $noserv=$_GET["noserv"];
//     $querydel="delete from services where no_serv=$noserv";
//     $rs=mysqli_query($db,$querydel);
//     mysqli_close($db);
// }

// function searchServ() {
//     $db=connexion();
//     $noserv=$_GET["noserv"];
//     $rs=mysqli_query($db, 'select * from services');
//         while ($data=mysqli_fetch_row ($rs)) {
//             if ($data[0]==$noserv) {
//                 echo
//                     '<h2>' . "Service " . $data[1] . '</h2></br>
//                     <p><strong>Numéro de service</strong> : ' . $data[0] . '</p></br>
//                     <p><strong>Ville</strong> : ' . $data[2] . '</p></br>' ;
//             }
//         }
//     mysqli_free_result($rs);
//     mysqli_close($db);  
//     return $rs;          
// }

// function searchNoServNotAffected() {
//     $db=connexion();
//     $query="select no_serv from services where no_serv in (select distinct no_serv from employes)";
//     $rs=mysqli_query($db,$query);
//     $info=mysqli_fetch_all ($rs, MYSQLI_ASSOC);
//     mysqli_free_result($rs);
//     mysqli_close($db);
//     return $info;
// }

?>