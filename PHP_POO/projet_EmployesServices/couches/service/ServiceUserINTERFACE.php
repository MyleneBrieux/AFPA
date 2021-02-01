<?php

interface ServiceUserInterface {

    public function ajoutUser($mail, $password);

    public function searchUser($mail);

    public function passwordHash($password);

    public function passwordVerify($password, $data);

}

?>