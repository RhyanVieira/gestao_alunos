<?php
//listaMensalidade.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM mensalidade ORDER BY status_pagamento DESC");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista de Mensalidades</h3>
        </div>
        <div class="col-2 text-end">
            <a href="dashboard.php?pagina=formMensalidade&acao=insert" class="btn-new" title="nova">Novo</a>
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
                            <th scope="col">Aluno</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col">Data de Pagamento</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="350">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_mensalidade'] ?></td>
                                    <td><?= $row['id_aluno'] ?></td>
                                    <td><?= $row['id_turma'] ?></td>
                                    <td class="text-right"><?= Funcoes::valorBr($row['valor']) ?></td>
                                    <td><?= date("d/m/Y", strtotime($row['data_vencimento'])) ?></td>
                                    <td><?= $row['data_pagamento'] ? date("d/m/Y", strtotime($row['data_pagamento'])) : 'Não pago' ?></td>
                                    <td><?= Funcoes::getStatusPagamento($row['status_pagamento']) ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formMensalidade&acao=update&id_mensalidade=<?= $row['id_mensalidade'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formMensalidade&acao=delete&id_mensalidade=<?= $row['id_mensalidade'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formMensalidade&acao=view&id_mensalidade=<?= $row['id_mensalidade'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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