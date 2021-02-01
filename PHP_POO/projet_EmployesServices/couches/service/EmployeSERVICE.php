<?php

// LIAISONS AVEC AUTRES COUCHES //
include_once("../dao/EmployeMysqliDAO.php");
include_once("ServiceEmpINTERFACE.php");

// GESTION DES ERREURS //
include_once("ServiceException.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


class EmployeService implements ServiceEmpInterface {

    public function __construct(){
        $this->employeDao = new EmployeMysqliDao;
    }


    public function connexion() {
        try {
            $mysqli = $this->employeDao->connexion();
            return $mysqli;
        } catch (DaoException $ce){
            throw new ServiceException($ce->getMessage(),$ce->getCode());
        }
    }

    public function add(object $gestion) : void {  
        try {
            $this->employeDao->add($gestion);
        } catch (DaoException $de){
            throw new ServiceException($de->getMessage(),$de->getCode());
        }
    }

    public function searchEmpPerDate(){
        $data = $this->employeDao->searchEmpPerDate();
        return $data;
    }

    // public function searchIntoTable($key,$value){
    //     $data = $this->employeDao->searchIntoTable($key,$value);
    //     return $data;
    // }

    public function edit(object $gestion) : void {
        try {
            $this->employeDao->edit($gestion);
        } catch (DaoException $fe){
            throw new ServiceException($fe->getMessage(),$fe->getCode());
        }
    }

    public function deleteEmp(int $noemp) : void {
        try {
            $this->employeDao->deleteEmp($noemp);
        } catch (DaoException $ge){
            throw new ServiceException($ge->getMessage(),$ge->getCode());
        }
    }

    public function search(int $gestion) : object {
        try {
            $data = $this->employeDao->search($gestion);
            return $data;
        } catch (DaoException $he){
            throw new ServiceException($he->getMessage(),$he->getCode());
        }
    }  

    public function selectAll() {
        try {
            $rs=$this->employeDao->selectAll();
            return $rs;
        } catch (DaoException $ie){
            throw new ServiceException($ie->getMessage(),$ie->getCode());
        }
    }  

    public function searchEmpNoSup(int $noemp) : ?bool {
        $delete=$this->employeDao->searchEmpNoSup($noemp);
        return $delete;
    }  

}

?>