<?php
//listaMatricula.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM matricula ORDER BY id_matricula");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista de Matrículas</h3>
        </div>
        <div class="col-2 text-end">
            <a href="dashboard.php?pagina=formMatricula&acao=insert" class="btn-new" title="nova">Novo</a>
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
                            <th scope="col">Data Matrícula</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="350">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_matricula'] ?></td>
                                    <td><?= date("d/m/Y", strtotime($row['data_matricula'])) ?></td>
                                    <td><?= Funcoes::getStatusMatricula($row['status_matricula']) ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formMatricula&acao=update&id_matricula=<?= $row['id_matricula'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formMatricula&acao=delete&id_matricula=<?= $row['id_matricula'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formMatricula&acao=view&id_matricula=<?= $row['id_matricula'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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