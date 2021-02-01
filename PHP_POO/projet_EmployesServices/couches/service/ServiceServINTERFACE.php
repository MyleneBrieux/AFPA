<?php

// LIAISON AVEC AUTRE COUCHE //
include_once("ServiceINTERFACE.php");

interface ServiceServInterface extends ServiceInterface {

    public function deleteServ(int $noserv);

    public function searchNoServNotAffected(int $noserv);

}

?>