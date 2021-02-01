<?php

// LIAISONS AVEC AUTRES COUCHES //
include_once("../dao/UserMysqliDAO.php");
include_once("ServiceUserINTERFACE.php");

// GESTION DES ERREURS //
include_once("ServiceException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


class UserService implements ServiceUserInterface {

    public function __construct(){
        $this->userDao = new UserMysqliDao;
    }


    public function connexion() {
        try {
            $mysqli = $this->userDao->connexion();
            return $mysqli;
        } catch (DaoException $de){
            throw new ServiceException($de->getMessage(),$de->getCode());
        }
    }

    public function ajoutUser($mail, $password) { 
        try {
            $this->userDao->ajoutUser($mail,$password);
        } catch (DaoException $fe){
            throw new ServiceException($fe->getMessage(),$fe->getCode());
        }
    }

    public function searchUser($mail) : ?array {
        try {
            $data = $this->userDao->searchUser($mail);
            return $data;
        } catch (DaoException $ge){
            throw new ServiceException($ge->getMessage(),$ge->getCode());
        }
    }

    public function passwordHash($password) {
        $newPassword=password_hash($password,PASSWORD_DEFAULT);
        return $newPassword;
    }

    public function passwordVerify($password, $data) {
        $passwordOk = password_verify($password,$data["password"]);
        return $passwordOk;
    }

}

?>