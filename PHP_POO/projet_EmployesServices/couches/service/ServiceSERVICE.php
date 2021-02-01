<?php

// LIAISONS AVEC AUTRES COUCHES //
include_once("../dao/ServiceMysqliDAO.php");
include_once("ServiceServINTERFACE.php");

// GESTION DES ERREURS // 
include_once("ServiceException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class ServiceService implements ServiceInterface {

    public function __construct(){
        $this->serviceDao = new ServiceMysqliDao;
    }


    public function connexion() {
        try {
            $mysqli=$this->serviceDao->connexion();
            return $mysqli;
        } catch (DaoException $ce){
            throw new ServiceException($ce->getMessage(),$ce->getCode());
        }
    }

    public function add(object $gestion) : void {        
        try {
            $this->serviceDao->add($gestion);
        } catch (DaoException $de){
            throw new ServiceException($de->getMessage(),$de->getCode());
        }
    }

    public function edit(object $gestion) : void {
        try {
            $this->serviceDao->edit($gestion);
        } catch (DaoException $fe){
            throw new ServiceException($fe->getMessage(),$fe->getCode());
        }
    }

    public function deleteServ(int $noserv) : void {
        try {
            $this->serviceDao->deleteServ($noserv);
        } catch (DaoException $ge){
            throw new ServiceException($ge->getMessage(),$ge->getCode());
        }
    }

    public function search(int $gestion) : object {
        try {
            $data = $this->serviceDao->search($gestion);
            return $data; 
        } catch (DaoException $he){
            throw new ServiceException($he->getMessage(),$he->getCode());
        }
    }  

    public function selectAll() {
        try {
            $rs = $this->serviceDao->selectAll();
            return $rs;
        } catch (DaoException $ie){
            throw new ServiceException($ie->getMessage(),$ie->getCode());
        }
    }  

    public function searchNoServNotAffected(int $noserv) : array {
        $info = $this->serviceDao->searchNoServNotAffected($noserv);
        return $info;
    }  

}

?>