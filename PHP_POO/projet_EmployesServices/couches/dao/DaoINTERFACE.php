<?php

interface DaoInterface {

    public function add(object $gestion);

    public function edit(object $gestion);

    public function search(int $gestion);

    public function selectAll();

}

?>