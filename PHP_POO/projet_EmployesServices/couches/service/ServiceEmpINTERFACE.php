<?php

// LIAISON AVEC AUTRE COUCHE //
include_once("ServiceINTERFACE.php");

interface ServiceEmpInterface extends ServiceInterface {

    public function deleteEmp(int $noemp);

    public function searchEmpNoSup(int $noemp);

}

?>