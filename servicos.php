<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM servicos WHERE status_registro = 1 ORDER BY posicao");

?>
<div class="container text-center header-pages">
    <h1>Nossos Serviços</h1>
</div>
<section class="container mt-5 mb-5 sobrenos">
    <?php foreach ($data as $aSobreNos): ?>

        <div class="subtitulo-pages mb-4 mt-5">
            <h4 class="line-under mb-4"><i class="<?= $aSobreNos['icone_bootstrap'] ?>"></i> <?= $aSobreNos['subtitulo'] ?></h4>
            <?= $aSobreNos['texto'] ?>
        </div>

    <?php endforeach; ?>
</section>