<?php
//listaMensalidade.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM mensalidade");

?>