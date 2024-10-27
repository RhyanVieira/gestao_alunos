
<?php
//listaCurso.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Cursos</h3>
        </div>
    </div>
    <div class="col-2 text-end">
        <a href="#" class="btn btn-outline-secondary btn-sm" title="nova">Nova</a>
    </div>

    <?= funcoes::mensagem() ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>Id</tr>
            <tr>Curso</tr>
            <tr>Valor</tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id_curso'] ?></td>
                        <td><?= $row['curso'] ?></td>
                        <td class="text-right"><?= funcoes::valorBr($row['valor']) ?></td>
                        </td>
                        <td>
                            <a href="index.php?pagina=formCurso&acao=update&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formCurso&acao=delete&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formCurso&acao=view&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Visualização">Visualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>             
        </tbody>
    </table>
</div>