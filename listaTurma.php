<?php
//listaTurma.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM turma");

?>
<?php
//listaMatricula.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM turma ORDER BY id_curso");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista de Turmas</h3>
        </div>
        <div class="col-2 text-end">
            <a href="dashboard.php?pagina=formTurma&acao=insert" class="btn-new" title="nova">Nova</a>
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
                            <th scope="col">Ano - Semestre</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Coordenador</th>
                            <th scope="col" width="300">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_turma'] ?></td>
                                    <td><?= $row['ano_semestre'] ?></td>
                                    <td><?= $row['nome_turma'] ?></td>
                                    <td><?= $row['id_curso'] ?></td>
                                    <td><?= $row['id_administrador'] ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formTurma&acao=update&id_turma=<?= $row['id_turma'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formTurma&acao=delete&id_turma=<?= $row['id_turma'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formTurma&acao=view&id_turma=<?= $row['id_turma'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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