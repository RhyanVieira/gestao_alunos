<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$aPropostas = $db->dbSelect("SELECT * FROM propostas WHERE status_registro = 1 ORDER BY posicao");

?>
<div class="container text-center header-pages">
    <h1>Nossas Propostas</h1>
</div>
<section class="container mt-5 mb-5 sobrenos">

    <?php foreach ($aPropostas as $propostas): ?>
        <div class="subtitulo-pages mb-4 mt-5">
            <h4 class="line-under mb-4"><i class="<?= $propostas['icone_bootstrap'] ?>"></i> <?= $propostas['subtitulo'] ?></h4>
            <?= $propostas['texto'] ?>
        </div>
    <?php endforeach; ?>

</section>