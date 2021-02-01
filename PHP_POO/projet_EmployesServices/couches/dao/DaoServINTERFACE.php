<?php

// LIAISON AVEC AUTRE COUCHE //
include_once("DaoINTERFACE.php");

interface DaoServInterface extends DaoInterface {

    public function deleteServ(int $noserv);

    public function searchNoServNotAffected(int $noserv);

}

?>