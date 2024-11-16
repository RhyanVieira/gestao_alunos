<?php
//listaDisciplina.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM disciplina ORDER BY id_curso");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-8">
            <h3 class="line-under">Lista de Disciplinas</h3>
        </div>
        <div class="col-4 text-end">
            <a href="dashboard.php?pagina=formDisciplina&acao=insert" class="btn-new" title="nova">Novo</a>
            <a href="dashboard.php?pagina=listaCurso" class="btn-back" title="nova">Voltar</a>
        </div>
    </div>

    <?= funcoes::mensagem() ?>

    <div class="row my-5 area-table-lista">
        <h3 class="fs-4 mb-3"></h3>
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">Id</th>
                            <th scope="col">Disciplina</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Carga Horária</th>
                            <th scope="col" width="350">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_disciplina'] ?></td>
                                    <td><?= $row['disciplina'] ?></td>
                                    <td><?= $row['id_curso'] ?></td>
                                    <td><?= $row['carga_horaria'] ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formDisciplina&acao=update&id_disciplina=<?= $row['id_disciplina'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formDisciplina&acao=delete&id_disciplina=<?= $row['id_disciplina'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formDisciplina&acao=view&id_disciplina=<?= $row['id_disciplina'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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
        </div>
    </div>
</div>