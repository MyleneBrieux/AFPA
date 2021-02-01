<?php

// LIAISONS AVEC AUTRES COUCHES //
include_once("../metier/User.php");
include_once("DaoUserINTERFACE.php");

// GESTION DES ERREURS //
include_once("DaoException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    class UserMysqliDao {

        public function connexion() {
            try {
                $mysqli= new mysqli('localhost','mylene','afpamy13','entreprise');
                return $mysqli;
            } catch (mysqli_sql_exception $d) {
                throw new DaoException($d->getMessage(), $d->getCode());
            }
        }

        public function ajoutUser(string $mail, string $password) {
            try {
                $mysqli=$this->connexion();
                $stmt = $mysqli->prepare("insert into user(id,mail,password,profil) values(null,?,?,'utilisateur')");
                $stmt->bind_param("ss",$mail,$password);
                $stmt->execute();
                $mysqli->close();
            } catch (mysqli_sql_exception $e){
                throw new DaoException($e->getMessage(),$e->getCode());
            }
        }
        
        public function searchUser(string $mail) : ?array {
            try {
                $mysqli=$this->connexion();
                $stmt = $mysqli->prepare("select * from user where mail=?");
                $stmt->bind_param("s",$mail);
                $stmt->execute();
                $rs = $stmt->get_result();
                $data = $rs->fetch_array(MYSQLI_ASSOC);
                $rs->free();
                $mysqli->close();
                return $data;
            } catch (mysqli_sql_exception $f) {
                throw new DaoException($f->getMessage(), $f->getCode());
            }
        }

    }

?>