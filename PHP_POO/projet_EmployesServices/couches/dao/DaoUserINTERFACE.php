<?php

interface DaoUserInterface {

    public function ajoutUser(string $mail, string $password);

    public function searchUser(string $mail);

}

?>