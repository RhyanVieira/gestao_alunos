<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$aSobreNos = $db->dbSelect("SELECT * FROM sobre_nos WHERE status_registro = 1 ORDER BY posicao");

?>

<div class="container text-center header-pages">
    <h1>Sobre nós</h1>
    <p>Na SmartClass, somos apaixonados por transformar a educação e impulsionar o futuro das instituições de ensino.
        Com uma abordagem inovadora e personalizada, nos dedicamos a oferecer soluções completas de captação e gestão de alunos, permitindo que as escolas, universidades e cursos de diversas áreas possam atrair, reter e gerir seu público de forma eficiente e estratégica.
    </p>
</div>
<section class="container mt-5 mb-5 sobrenos">

    <?php foreach ($aSobreNos as $sobreNos): ?>
        <div class="subtitulo-pages mb-4 mt-5">
            <h4 class="line-under mb-4"><i class="<?= $sobreNos['icone_bootstrap'] ?>"></i> <?= $sobreNos['subtitulo'] ?></h4>
            <?= $sobreNos['texto'] ?>
        </div>
    <?php endforeach; ?>

</section>