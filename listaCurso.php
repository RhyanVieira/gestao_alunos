<?php
//listaCurso.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-8">
            <h3 class="line-under">Lista de Cursos</h3>
        </div>
        <div class="col-4 text-end">
            <a href="dashboard.php?pagina=listaDisciplina" class="btn-new" title="nova">Adicionar Disciplina</a>
            <a href="dashboard.php?pagina=formCurso&acao=insert" class="btn-new" title="nova">Novo</a>
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
                            <th scope="col">Curso</th>
                            <th scope="col">Duração (Horas)</th>
                            <th scope="col">Mensalidade</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="350">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_curso'] ?></td>
                                    <td><?= $row['curso'] ?></td>
                                    <td><?= $row['duracao_curso'] ?></td>
                                    <td class="text-right"><?= Funcoes::valorBr($row['valor_curso']) ?></td>
                                    <td><?= Funcoes::getStatusRegistro($row['status_registro']) ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formCurso&acao=update&id_curso=<?= $row['id_curso'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formCurso&acao=delete&id_curso=<?= $row['id_curso'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formCurso&acao=view&id_curso=<?= $row['id_curso'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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