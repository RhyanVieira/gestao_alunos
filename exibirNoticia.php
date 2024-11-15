<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$noticia = null;
if (isset($_GET['id_noticias'])) {
    $id = $_GET['id_noticias'];
    $noticia = $db->dbSelect("SELECT * FROM noticias WHERE id_noticias = ? 
                                AND status_registro = 1", 
                                'first', 
                                [$id]
    );
}

?>

<div class="container text-center header-pages">
    <h1><?= $noticia['titulo'] ?></h1>
</div>
<section class="container mt-5 mb-5 sobrenos">
    <p><?= $noticia['texto'] ?></p>
</section>