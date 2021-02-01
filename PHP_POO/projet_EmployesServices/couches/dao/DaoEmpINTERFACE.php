<?php

// LIAISON AVEC AUTRE COUCHE //
include_once("DaoINTERFACE.php");

interface DaoEmpInterface extends DaoInterface {

    public function deleteEmp(int $noemp);

    public function searchEmpNoSup(int $noemp);

}

?>