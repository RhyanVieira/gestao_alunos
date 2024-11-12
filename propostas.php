<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM propostas WHERE status_registro = 1 ORDER BY posicao");

?>
<div class="container text-center header-pages">
    <h1>Nossas Propostas</h1>
</div>
<section class="container mt-5 mb-5 sobrenos">
    <?php foreach ($data as $aProposta): ?>

        <div class="subtitulo-pages mb-4 mt-5">
            <h4 class="line-under mb-4"><i class="<?= $aProposta['icone_bootstrap'] ?>"></i> <?= $aProposta['subtitulo'] ?></h4>
            <?= $aProposta['texto'] ?>
        </div>

    <?php endforeach; ?>
</section>