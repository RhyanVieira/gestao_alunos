<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$ultimas = $db->dbSelect("SELECT * FROM noticias WHERE status_registro = 1 ORDER BY data_postagem DESC LIMIT 3");
$proximasNoticias = $db->dbSelect("SELECT * FROM noticias WHERE status_registro = 1 ORDER BY data_postagem DESC LIMIT 3 OFFSET 3");

?>

<div class="container text-center header-pages">
    <h1>Blog de Captação e Gestão de Alunos</h1>
    <p>Explore as últimas notícias e artigos para otimizar a gestão acadêmica e impulsionar sua instituição.</p>
</div>

<section class="container mt-5 mb-5 blog">
    <h4 class="mb-4 line-under">Últimos Artigos</h4>
    <?php foreach ($ultimas as $aUltimas): ?>
        <div class="col-12 col-md-12 col-lg-4">
            <a href="index.php?pagina=exibirNoticia&id_noticias=<?= $aUltimas['id_noticias'] ?>" class="card-link">
                <div class="card h-100">
                    <img src="uploads/noticias/<?= $aUltimas['imagem'] ?>" class="card-img-top" alt="Notícia 2">
                    <div class="card-body">
                        <h5 class="card-title"><?= $aUltimas['titulo']?></h5>
                        <p class="card-text"><?= $aUltimas['texto_card']?>></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    <h4 class="mb-4 mt-5 line-under">Artigos Anteriores</h4>
    <div class="row ">
        <?php foreach ($proximasNoticias as $aProximasNoticias): ?>
            <div class="col-12 col-md-12 col-lg-4">
                <a href="index.php?pagina=exibirNoticias&id_noticias=<?= $aProximasNoticias['id_noticias'] ?>" class="card-link">
                    <div class="card h-100">
                        <img src="uploads/noticias/<?= $aProximasNoticias['imagem'] ?>" class="card-img-top" alt="Notícia 2">
                        <div class="card-body">
                            <h5 class="card-title"><?= $aProximasNoticias['titulo']?></h5>
                            <p class="card-text"><?= $aProximasNoticias['texto_card']?>></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>